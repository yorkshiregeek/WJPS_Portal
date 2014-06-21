// Sortable rows


$('.sorted_table').sortable({
  containerSelector: 'table',
  itemPath: '> tbody',
  itemSelector: 'tr',
  placeholder: '<tr class="placeholder"/>',

  onDrop: function (item, container, _super) {


    var obj = jQuery('.sorted_table tr').map(function(){
                return  jQuery (this).attr("data-id");
            }).get();
          console.log(obj)
           
            $.ajax({
                url: "ajax_action.php",
                type: "post",
                data: dataToSend,
                cache: false,
                dataType: "json",
                success: function () {}
            });
            //_super(item, container);
        }
})


