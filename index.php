<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>View File Folder</title>
    <meta name="viewport" content="width=device-width" />
    <!-- <link rel="stylesheet" href="//static.jstree.com/latest/assets/dist/themes/default/style.min.css" /> -->
    <link rel="stylesheet" href="tree_dist/themes/default/style-edit.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" />
    <style>
        html,
        body {
            background: #ebebeb;
            font-size: 10px;
            font-family: Verdana;
            margin: 0;
            padding: 0;
        }

        #container {
            min-width: 320px;
            margin: 0px auto 0 auto;
            background: white;
            border-radius: 0px;
            padding: 0px;
            overflow: hidden;
        }

        #tree {
            float: left;
            min-width: 319px;
            border-right: 1px solid silver;
            overflow: auto;
            padding: 0px 0;
        }

        #data {
            margin-left: 320px;
        }

        #data textarea {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            border: 0;
            background: white;
            display: block;
            line-height: 18px;
        }

        #data,
        #code {
            font: normal normal normal 12px/18px 'Consolas', monospace !important;
        }


        .content.default {
            line-height: inherit !important;
            display: flex;
            overflow: auto;
        }

        .content.default>div {
            clear: both;
            /* position: absolute; */
            width: 100%;
            max-width: 1200px;
            padding: 10px;
        }
        .f-event button{
            float: right;
            padding: 5px;
            margin-top: 10px;
            background: #0000ff26;
        }
        .f-add button{
            float: right;
            padding: 5px;
            margin-bottom: 10px;
            background: #0000ff26;
        }
        td .btn {
            text-decoration: underline;
            color: #0f0fdf;
        }
    </style>
</head>

<body>
    <div id="container" role="main">
        <div id="tree"></div>
        <div id="data">
            <div class="content code" style="display:none;"><textarea id="code" readonly="readonly"></textarea></div>
            <div class="content folder" style="display:none;"></div>
            <div class="content image" style="display:none; position:relative;"><img src="" alt="" style="display:block; position:absolute; left:50%; top:50%; padding:0; max-height:90%; max-width:90%;" /></div>
            <div class="content default" id="can-upload" style="text-align:center;">
                <div>
                    <div class="f-add">
                        <button>Upload media</button>
                    </div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="select-checkbox"></th>
                                <th>File name</th>
                                <th>File size</th>
                                <th>File type</th>
                                <th>Last modified</th>
                                <th>Owner</th>
                                <th>Url</th>
                            </tr>
                        </thead>
                        
                    </table>
                    <div class="f-event">
                        <button>Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="//static.jstree.com/latest/assets/dist/libs/jquery.js"></script>
		<script src="//static.jstree.com/latest/assets/dist/jstree.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
    <script src="tree_dist/jstree.min.js"></script>


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "processing": true,
                "serverSide": true,

                "ajax": "server_processing.php",

                'columnDefs': [{
                    'orderable': false,
                    'targets': 0,
                    'className': 'select-checkbox',
                }],
                'select': {
                    // 'style':    'os',
                    'style': 'multi',
                    'selector': 'td:first-child',
                },
                order: [[ 1, 'asc' ]],
            });
        });



        $(function() {
            $(window).resize(function() {
                var h = Math.max($(window).height() - 0, 420);
                $('#container, #data, #tree, #data .content').height(h).filter('.default').css('lineHeight', h + 'px');
            }).resize();

            $('#tree')
                .jstree({
                    'core': {
                        'data': {
                            'url': 'index5_ajax.php?operation=get_node',
                            'data': function(node) {
                                return {
                                    'id': node.id
                                };
                            }
                        },
                        'force_text': true,
                        'check_callback': true,
                        'themes': {
                            'responsive': false
                        }
                    },
                    'plugins': ['state', 'contextmenu', 'wholerow', 'unique'],
                    "contextmenu": {
                        "items": function($node) {
                            var tree = $("#tree").jstree(true);
                            return {
                                "Create": {
                                    "separator_before": false,
                                    "separator_after": false,
                                    "label": "Create",
                                    "action": function(obj) {
                                        $node = tree.create_node($node);
                                        tree.edit($node);
                                    }
                                },
                                "Rename": {
                                    "separator_before": false,
                                    "separator_after": false,
                                    "label": "Rename",
                                    "action": function(obj) {
                                        tree.edit($node);
                                    }
                                },
                            };
                        }
                    },'unique' : {
                        'duplicate' : function (name, counter) {
                            return name + ' ' + counter;
                        }
                    },
                })
                .on('delete_node.jstree', function(e, data) {
                    $.get('index5_ajax.php?operation=delete_node', {
                            'id': data.node.id
                        })
                        .fail(function() {
                            data.instance.refresh();
                        });
                })
                .on('create_node.jstree', function(e, data) {
                    $.get('index5_ajax.php?operation=create_node', {
                            'id': data.node.parent,
                            'position': data.position,
                            'text': data.node.text
                        })
                        .done(function(d) {
                            data.instance.set_id(data.node, d.id);
                        })
                        .fail(function() {
                            data.instance.refresh();
                        });
                })
                .on('rename_node.jstree', function(e, data) {
                    
					$.get('index5_ajax.php?operation=rename_node', {
                            'id': data.node.id,
                            'text': data.text
                        })
                        .fail(function() {
                            data.instance.refresh();
                        });
						
						/*
						jQuery.post('index5_ajax.php?operation=rename_node', {
                        'id': data.node.id,
                        'name': data.text
                    }, function(data) {}, "json")
                    .done(function(d) {
                        if (d.status === false) {
                            alert(d.message);
                            data.instance.refresh();
                        }else{
                            data.node.original.path = d.path;
                            id_folder_path = d.path;
                            jQuery('#tree').jstree(true).refresh_node(data.node.id);
                        }
                    })
                    .fail(function() {
                        data.instance.refresh();
                    });
					*/
                })
                .on('move_node.jstree', function(e, data) {
                    $.get('index5_ajax.php?operation=move_node', {
                            'id': data.node.id,
                            'parent': data.parent,
                            'position': data.position
                        })
                        .fail(function() {
                            data.instance.refresh();
                        });
                })
                .on('copy_node.jstree', function(e, data) {
                    $.get('index5_ajax.php?operation=copy_node', {
                            'id': data.original.id,
                            'parent': data.parent,
                            'position': data.position
                        })
                        .always(function() {
                            data.instance.refresh();
                        });
                })
                .on('changed.jstree', function(e, data) {
                    if (data && data.selected && data.selected.length) {
						console.log('change content');
						console.log(data.node)
                        //  $.get('index5_ajax.php?operation=get_content&id=' + data.selected.join(':'), function(d) {
                        //$('#data .default').text(d.content).show();
                        //$('#data .default').html(d.content).show();
                        //  });
                    } else {
                        //$('#data .content').hide();
                        //$('#data .default').text('Select a file from the tree.').show();
                    }
                });
        });
    </script>
</body>

</html>