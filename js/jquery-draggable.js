// Sortable rows


$('.sorted_table').sortable({
  containerSelector: 'table',
  itemPath: '> tbody',
  itemSelector: 'tr',
  placeholder: '<tr class="placeholder"/>',

  onDrop: function ($item, container, _super) {
 
$item.removeClass("dragged").removeAttr("style")
      $("body").removeClass("dragging")
    var obj = jQuery('.sorted_table tr').map(function(){
                return  jQuery (this).attr("data-id");
            }).get();
          console.log(obj)
           
            $.ajax({
                url: "Ajax-php/positionupdate.php?Update=" + obj,
                type: "post",
                data: {info:obj},
                //dataType: "json",
                cache: false,
                success: function () {}
            });
            //_super(item, container);
        }
})


