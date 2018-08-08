<?php ?>
<div class="col-sm-12">
    <button class="btn btn-primary" id="add_root" ><span class="fa fa-plus"> Add</span></button>
    <button class="btn btn-warning" id="rename"><span class="fa fa-pencil"> Rename</span></button>
    <button class="btn btn-danger" id="delete"><span class="fa fa-trash"> Delete</span></button>
</div>
<div class="col-sm-12 no_lpad">
    <div class="col-sm-3 no_lpad" id="jstree"></div>
    <div class="col-sm-9 no_rpad">       
        <!-- form start -->
        <form class="form-horizontal">
            <div id="form_load">
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</div>
<script type="text/javascript">
    // Setup the jsTree.
    $(function () {
        var clicked_ele = '';
        var ele_count = 1;
        $('#jstree').jstree({
            "plugins": ["dnd", "types"],
            'core': {
                'data': {
                    "url": "tree/get_tree_data",
                    "dataType": "json" // needed only if you do not supply JSON headers
                },
                'check_callback': true

            }
        }).on("changed.jstree", function (e, data) {
            if (data.selected.length) {
                clicked_ele = data.instance.get_node(data.selected[0]);
                console.log('clicked_ele', clicked_ele);
                render_menu_form(clicked_ele);
                //make ajax call to fetch perm details
                //alert('The selected node is: ' + data.instance.get_node(data.selected[0]).text);
            }
        }).on("create_node.jstree", function (e, data) {
            console.log('New node created', data);
        }).on('delete_node.jstree', function (e, data) {
            console.log('Delete node', data);
        }).on('rename_node.jstree', function (e, data) {
            console.log('Rename node', data);
        }).on('move_node.jstree', function (e, data) {
            update_parent(data);
        });
        //add new node
        $('#add_root').on('click', function () {
            var instance = $('#jstree').jstree(true);
            createNode(instance.get_selected(), "new_node_" + ele_count, "New node", "last");
            ele_count++;
        });

        //delete node        
        $('#delete').on('click', function () {
            var instance = $('#jstree').jstree(true);
            instance.delete_node(instance.get_selected());
        });

        $('#rename').on('click', function () {
            var instance = $('#jstree').jstree(true);
            var sel = instance.get_selected();
            if (!sel.length) {
                return false;
            }
            sel = sel[0];
            instance.edit(sel);
        });

        // When the jsTree is ready, add two more records.
        $('#jstree').on('ready.jstree', function (e, data) {
            //var instance = $('#jstree').jstree(true);
            //createNode($("#jstree"), "another_base_directory", "Another Base Directory", "first");
            //createNode($("#base_directory"), "sub_2", "Sub 2", "last");
        });
        // Helper method createNode(parent, id, text, position).
        // Dynamically adds nodes to the jsTree. Position can be 'first' or 'last'.
        function createNode(parent_node, new_node_id, new_node_text, position) {
            
            if (parent_node.length) {
                $('#jstree').jstree('create_node', parent_node, {"text": new_node_text, "id": new_node_id}, position, false, false);
            } else {
                $("#jstree").jstree("create_node", null, null, "last", function (node) {
                    this.edit(node);
                });
            }
        }

        function render_menu_form(node_data) {
            myApp.Ajax.controller = 'tree';
            myApp.Ajax.method = 'get_menu_details_form';
            myApp.Ajax.form_method = 'POST';
            myApp.Ajax.post_data = {id: node_data.id};
            myApp.Ajax.genericAjax($("#form_load"), 'html');
        }
        function update_parent(node_data) {
            console.log('node=', node_data.node);
            console.log('node parent=', node_data.parent);
            console.log(node_data);

            //alert('update_parent');

            myApp.Ajax.controller = 'tree';
            myApp.Ajax.method = 'update_parent_and_order';
            myApp.Ajax.form_method = 'POST';
            myApp.Ajax.post_data = {id: node_data.node.id, 'parent': node_data.parent, 'position': node_data.position};
            myApp.Ajax.genericAjax();
        }

    });
</script>