var ft_list;
var cookie = [];

function computeCookie()
{
    var todo = ft_list.children;
    var newCookie = [];
    for (var i = 0; i < todo.length; i++)
        newCookie.unshift(todo[i].innerHTML);
    document.cookie = JSON.stringify(newCookie);
}

window.onload = function ()
{
    document.querySelector("#new").addEventListener("click", newTodo);
    ft_list = document.querySelector("#ft_list");
    var tmp = document.cookie;
    if (tmp)
    {
        try
        {
            cookie = JSON.parse(tmp);
            cookie.forEach(function (e) {
            addTodo(e);
        });
        } catch(e)
        {

        }
    }
};

window.onunload = function ()
{
    computeCookie();
};

function newTodo()
{
    var todo = prompt("Que dois-tu faire ?", '');
    if (todo !== '') {
        addTodo(todo)
    }
}

function addTodo(todo)
{
    var div = document.createElement("div");
    div.innerHTML = todo;
    div.addEventListener("click", deleteTodo);
    ft_list.insertBefore(div, ft_list.firstChild);
    computeCookie();
}

function deleteTodo()
{
    if (confirm("Veux-tu vraiment supprimer cette tâche ?"))
    {
        this.parentElement.removeChild(this);
        computeCookie();
    }
}