<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Upload File</title>
    <meta name="viewport" content="width=device-width" />
    <!-- <link rel="stylesheet" href="//static.jstree.com/latest/assets/dist/themes/default/style.min.css" /> -->
    <link rel="stylesheet" href="tree_dist/themes/default/style-edit.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link href="css/styles-uploader.css" rel="stylesheet">

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


        .content.default{
            line-height: inherit!important;
            display: flex;
            overflow: auto;
        }
        .content.default>div{
            clear: both;
            /* position: absolute; */
            width: 100%;
            max-width: 1200px;
            padding: 10px;
        }

        .debug-show{
            display: none;
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
                <main role="main" class="container">
                    <div class="row">
                    <div class="col-md-12 col-sm-12">
                        
                        <!-- Our markup, the important part here! -->
                        <div id="drag-and-drop-zone" class="dm-uploader p-5">
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                        <div class="btn btn-primary btn-block mb-5">
                            <span>Open the file Browser</span>
                            <input type="file" title='Click to add Files' />
                        </div>
                        </div><!-- /uploader -->

                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="card h-100">
                        <div class="card-header">
                            File List
                        </div>

                        <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                            <li class="text-muted text-center empty">No files uploaded.</li>
                        </ul>
                        </div>
                    </div>
                    </div><!-- /file list -->


                    <div class="row debug-show">
                    <div class="col-12">
                        <div class="card h-100">
                        <div class="card-header">
                            Debug Messages
                        </div>

                        <ul class="list-group list-group-flush" id="debug">
                            <li class="list-group-item text-muted empty">Loading plugin....</li>
                        </ul>
                        </div>
                    </div>
                    </div> <!-- /debug -->

                    </main> <!-- /container -->
                </div>
            </div>
        </div>
        <input type="file" id="file" style="display: none;">
    </div>

    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>

    <!-- <script src="//static.jstree.com/latest/assets/dist/libs/jquery.js"></script>
		<script src="//static.jstree.com/latest/assets/dist/jstree.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
    <script src="tree_dist/jstree.min.js"></script>
    

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->

    <script src="js/jquery.dm-uploader.min.js"></script>
    <script src="js/script-upload.js"></script>

    <script>

        // $(document).ready(function() {
        //     $('#example').DataTable( {
        //         "processing": true,
        //         "serverSide": true,
        //         "ajax": "server_processing.php"
        //     } );
        // } );



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
                    'plugins': ['state', 'contextmenu', 'wholerow'],
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