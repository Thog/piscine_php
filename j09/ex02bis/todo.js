var ft_list;
var cookie = [];

function computeCookie()
{
    var todo = ft_list.children();
    var newCookie = [];
    for (var i = 0; i < todo.length; i++)
        newCookie.unshift(todo[i].innerHTML);
    document.cookie = JSON.stringify(newCookie);
}

$(document).ready(function()
{
    $('#new').click(newTodo);
    $('#ft_list div').click(deleteTodo);
    ft_list = $('#ft_list');
    var tmp = document.cookie;
    if (tmp)
    {
        cookie = jQuery.parseJSON(tmp);
        cookie.forEach(function (e) {
            addTodo(e);
        });
    }
});

$(window).unload(function()
{
    computeCookie();
})

function newTodo()
{
    var todo = prompt("Que dois-tu faire ?", '');
    if (todo !== '')
    {
        addTodo(todo)
        computeCookie();
    }
}

function addTodo(todo)
{
    ft_list.prepend($('<div>' + todo + '</div>').click(deleteTodo));
}

function deleteTodo()
{
    if (confirm("Veux-tu vraiment supprimer cette tâche ?"))
    {
        computeCookie();
        this.remove();
    }
}