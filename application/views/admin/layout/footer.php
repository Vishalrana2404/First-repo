</div>
        <!-- ./wrapper -->
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url(); ?>webroot/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>webroot/js/bootbox.min.js"></script>      
        <script src="<?php echo base_url(); ?>webroot/js/app.min.js"></script>
        <script src="<?php echo base_url(); ?>webroot/js/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>webroot/js/moment.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="<?php echo base_url(); ?>webroot/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- calendar -->      
        <script src="<?php echo base_url(); ?>webroot/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="<?php echo base_url(); ?>webroot/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>webroot/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>webroot/js/dataencrypt.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>webroot/js/bootstrap-select.min.js"></script>
        <script src="<?php echo base_url(); ?>webroot/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
        <!-- Common for all -->
        <script type="text/javascript">
                // $('.selectpicker').selectpicker('hide');
            $("#msg_div").fadeOut(10000);  
        </script>   
        <script type="text/javascript">
            function changeStatus(tbl_name, status_column, status_val, id_column, id_Val)
            {
              var str = 'tbl_name='+tbl_name+'&status_column='+status_column+'&status_val='+status_val+'&id_column='+id_column+'&id_Val='+id_Val+'&<?php echo $this->security->get_csrf_token_name(); ?>='+'<?php echo $this->security->get_csrf_hash(); ?>';
              var PAGE = '<?php echo base_url().MODULE_NAME; ?>common/changeStatus';
              jQuery.ajax({
                  type :"POST",
                  url  :PAGE,
                  data : str,
                  success:function(data)
                  {        
                      return true;
                  } 
              });
            }
            $(function() 
            {
                $( ".current_date_val" ).datepicker({
                    dateFormat : 'yy-mm-dd',
                    changeMonth : true,
                    changeYear : true,  
                    minDate:new Date(),      
                });

                $(document).on('focus', '.current_date_val', function(){
                    $(this).datepicker({
                        dateFormat : 'yy-mm-dd',
                        changeMonth : true,
                        changeYear : true,  
                        minDate:new Date(),      
                    });
                })

                $( ".date_val" ).datepicker({
                    dateFormat : 'yy-mm-dd',
                    changeMonth : true,
                    changeYear : true,  
                });

                $( ".b_date_val" ).datepicker({
                    dateFormat : 'yy-mm-dd',
                    changeMonth : true,
                    changeYear : true,   
                    changeDate : true,   
                    yearRange: "-70: +0"
                });

                $(".timepicker").timepicker({
                    showInputs: false,
                    minuteStep: 5,
                    showMeridian: true,
                });

                $(".timepicker_lc_s").timepicker({
                    showInputs: false,
                    showMeridian: false,
                    minuteStep: 5
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();
           
                $.fn.dataTable.ext.errMode = 'none';

                $('#example_scroll').DataTable({
                   "paging": false,
                   "lengthChange": false,
                   "searching": false,
                   "ordering": false,
                   "info": false,
                   "autoWidth": false,
                   "scrollX": true,
                });
                $('#example').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });

            $.validate({
                modules : 'date, security, file',
                onModulesLoaded : function() {}
            });
        </script>
        <script type="text/javascript" src="<?php echo base_url();?>webroot/plugins/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
            selector: "textarea.tiny_textarea",
            plugins :"advlist autolink link image lists charmap print preview code fullscreen textcolor table media",
            tools: "inserttable", 
            relative_urls: false,
            toolbar: [ "undo redo | styleselect | bold italic | link image | bullist numlist outdent indent | alignleft aligncenter alignright alignjustify  forecolor backcolor | fontsizeselect | sizeselect | fontselect", ]
            });
            tinymce.init({
                // fontsize_formats: "1pt 2pt 3pt 4pt 5pt 6pt 7pt",
                selector: "textarea.tiny_textarea_disabled",
                relative_urls: false,            
                readonly : 1
            });
        </script>
        <script type="text/javascript">
            var table = $('.box-body').find('table');
            if(!table.parent('div').hasClass('table-responsive')) 
            {
                table.wrap('<div class="table-responsive"></div>');
            }
            if($('table thead tr').hasClass('label-primary'));
            {
                $('table thead tr').removeClass('label-primary')
            }
        </script>    
        <!-- <script type="text/javascript">
            /* google API */
            let placeSearch;
            let autocomplete;
            const componentForm = {
                full_address: "long_name",
            };

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search predictions to
                // geographical location types.
                autocomplete = new google.maps.places.Autocomplete(
                    document.getElementById("center_address"), {
                        types: ["geocode"]
                    }
                );
                console.log(autocomplete);
                // Avoid paying for data that you don't need by restricting the set of
                // place fields that are returned to just the address components.
                autocomplete.setFields(["address_component"]);
                // When the user selects an address from the drop-down, populate the
                // address fields in the form.
                autocomplete.addListener("place_changed", fillInAddress);
            }

            function fillInAddress() {
                var place = autocomplete.getPlace();
            }

            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        const geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;
                        document.getElementById("latitude").value = latitude;
                        document.getElementById("longitude").value = longitude;

                        const circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy,
                        });
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }

            jQuery(document).ready(function() {
                let placeSearch;
                let autocomplete;
                const componentForm = {
                    full_address: "long_name",
                };
                geolocate();
                initAutocomplete();
            });
        </script>
        <script src='https://maps.googleapis.com/maps/api/js?v=3&sensor=false&amp;libraries=places&key=AIzaSyAxnb1FiLG6k0hpU4AevWAYAtzbandQfK0'></script> -->
    </body>
</html>