var ft_list;
var cookie = [];

function loadData()
{
    ft_list.empty();
    ajaxCallback('select.php', "GET", null, function(data)
    {
        data = jQuery.parseJSON(data);
        jQuery.each(data, function(i, val) {
            ft_list.prepend($('<div data-id="' + i + '">' + val + '</div>').click(deleteTodo));
        });
    });
}

$(document).ready(function()
{
    $('#new').click(newTodo);
    $('#ft_list div').click(deleteTodo);
    ft_list = $('#ft_list');
    loadData();
});

function newTodo()
{
    var todo = prompt("Que dois-tu faire ?", '');
    if (todo !== '')
        ajaxCallback('insert.php', "GET", {'todo': todo}, loadData);
}

function deleteTodo()
{
    if (confirm("Veux-tu vraiment supprimer cette tâche ?"))
        ajaxCallback('delete.php', "GET", {id: $(this).data('id')}, loadData);
}

function ajaxCallback(url, method, data, success)
{
    $.ajax({
            method: method,
            url: url,
            data: data
        })
        .done(function (data) {
            success(data);
        })
        .error(function (msg) {
            alert("error ajax : " + msg);
        });
}
