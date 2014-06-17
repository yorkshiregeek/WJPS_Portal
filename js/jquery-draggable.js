$(document).ready(function() {
     $tabs = $(".tabbable");

    $('.nav-tabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    })
    
    $( "tbody.connectedSortable" )
        .sortable({
            connectWith: ".connectedSortable",
            items: "> tr:not(:first)",
            appendTo: $tabs,
            helper:"clone",
            zIndex: 999990,
            start: function(){ $tabs.addClass("dragging") },
            stop: function(){ $tabs.removeClass("dragging") }
        })
        .disableSelection()
    ;
    
    var $tab_items = $( ".nav-tabs > li", $tabs ).droppable({
      accept: ".connectedSortable tr",
      hoverClass: "ui-state-hover",
      over: function( event, ui ) {
        var $item = $( this );
        $item.find("a").tab("show");
        
      },
      drop: function( event, ui ) {
        return false;
      }
    });
    
});