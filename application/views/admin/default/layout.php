<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo $base_assets_url; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo $base_assets_url; ?>css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo $base_assets_url; ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo $base_assets_url; ?>css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo $base_assets_url; ?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <link href="<?php echo $base_assets_url; ?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo $base_assets_url; ?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo $base_assets_url; ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $base_assets_url; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />


    <!-- Line Control WYSIWYG -->


    <!-- Bootstrap Datepicker -->
    <link href="<?php echo $base_assets_url; ?>plugins/datepicker/css/datepicker.css" type="text/css" rel="stylesheet" />

    <!-- Select2 -->
    <link href="<?php echo $base_assets_url; ?>plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />


    <link href="<?php echo $base_assets_url; ?>css/custom.css" rel="stylesheet" type="text/css" />
    <style>
        .ck-editor {
            min-width: 800px !important;
        }

        .ck-content {
            min-height: 400px;
        }
    </style>
    <script src="<?php echo BASE_URI; ?>assets/ckeditor5/ckeditor.js"></script>
    <script src="<?php echo BASE_URI; ?>assets/ckfinder/ckfinder.js"></script>

    <script type="text/javascript">
        var SERVER = '<?php echo site_url("/") ?>';
        var BASE_URI = '<?php echo BASE_URI; ?>';
    </script>
    <!-- jQuery 2.0.2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- jQuery UI 1.10.3 -->
    <script src="<?php echo $base_assets_url; ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $base_assets_url; ?>js/bootstrap.min.js" type="text/javascript"></script>

    <script src="<?php echo $base_assets_url; ?>js/custom.js" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>

<body class="skin-black">
    <?php echo $header; ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <?php echo $sidebar; ?>
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $content_title; ?>
                    <small><?php echo $content_title_sub; ?></small>
                </h1>
                <!-- <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol> -->
            </section>

            <!-- Main content -->
            <section class="content">
                <?php echo $content; ?>
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- add new calendar event modal -->



    <!-- Morris.js charts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo $base_assets_url; ?>js/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo $base_assets_url; ?>js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo $base_assets_url; ?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo $base_assets_url; ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- fullCalendar -->
    <script src="<?php echo $base_assets_url; ?>js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo $base_assets_url; ?>js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo $base_assets_url; ?>js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo $base_assets_url; ?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo $base_assets_url; ?>js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

    <!-- Bootstrap Datepicker -->
    <script src="<?php echo $base_assets_url; ?>plugins/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo $base_assets_url; ?>js/AdminLTE/app.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo $base_assets_url; ?>js/AdminLTE/dashboard.js" type="text/javascript"></script>

    <!-- Select2 -->
    <script src="<?php echo $base_assets_url; ?>plugins/select2/js/select2.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').datepicker();
            $('.select2').select2();
            $(".select2-tags").select2({
                tags: true
            })
        })
    </script>
    <script>
        function getCookie(name) {
            var arr = document.cookie.match(
                new RegExp("(^| )" + name + "=([^;]*)(;|$)")
            );
            if (arr != null) return unescape(arr[2]);
            return null;
        }
        $('input.discomm-check').on('ifToggled', function(event) {
            // alert(event.type + ' callback');
            console.log(event.currentTarget.checked);
            var published = (event.currentTarget.checked) ? "1" : "0"
            if (published == "1") {
                var checked = $("#published_value").val('1');
            } else {
                var checked = $("#published_value").val('0');
            }
            // console.log(published);
            var query = "id=" + $(this).data("id") + "&published=" + published + "&csrf_tsj=" + getCookie("csrf_cookie_tsj");
            $.ajax({
                url: "/admin/comments/com_dispaly",
                type: "POST",
                data: query,
                dataType: "json",
                success: function(response) {
                    // Update CSRF hash
                    console.log(response);

                },
            });
        });
    </script>
    <script>
        function editFordata(data) {
            if (data.id != undefined) {
                $('#writer').val(data.writer);
                $('#c-content').val(data.content);
                $('#id').val(data.id);
                if (data.published == "1") {
                    $("select[name=published]").val("1");

                } else {
                    $("select[name=published]").val("0");
                }
                $('#myModal').modal('show');
            } else {
                $('#writer').val("");
                $('#c-content').val("");
                $('#id').val("");
                $("select[name=published]").val("0");
                $('#myModal').modal('show');
            }
        }
    </script>
</body>

</html>