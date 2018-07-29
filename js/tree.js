(function ($) {
    function TreeView(){
        
    }
    var tree_settings = {};
    $.fn.treeView = function (options) {
        // This is the easiest way to have default options.
        tree_settings = $.extend({
            'root_ul': $('.root_ul'),
            'root_add': $('#add_root'),
            'node_add': $('.node_add'),
        }, options);
        var instance = this;
        var selected_node = '';
        var node_no=1;
        var root_node_ele = $('<ul class="root_ul"></ul>');        
        var node_html = '<li class="node"></li>';
        
        function create_node(){
            
        }
        $(document).on('click','.node li', function () {  
            alert('okk');
            set_selected_node($(this));
        });
        tree_settings.root_add.on('click', function () {
            create_node();
        });
    };
}(jQuery));