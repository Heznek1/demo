<footer class="footer">
    <div class="container-fluid clearfix">
            <span class="float-right">

            </span>
    </div>
</footer>

<!-- partial -->
</div>
</div>

</div>

<script src="/StarAdmin-Free-Bootstrap-Admin-Template/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5NXz9eVnyJOA81wimI8WYE08kW_JMe8g&callback=initMap" async defer></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/js/off-canvas.js"></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/js/hoverable-collapse.js"></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/js/misc.js"></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/js/chart.js"></script>
<script src="/StarAdmin-Free-Bootstrap-Admin-Template/js/maps.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.16.1/jquery.daterangepicker.min.js"></script>

<script src="http://code.jquery.com/jquery-migrate-3.0.0.js"></script>

<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script src="/js/main.js"></script>

<?php
if(isset($users_json) and !empty($users_json)) {
    ?> <script>
            $(document).ready(function() {
                $('.user-search').autocomplete({
                    source: JSON.parse('<?=$users_json?>'),
                    messages: {
                        noResults: '',
                        results: function() {}
                    },
                    select: function(event, ui) {
                        var id = ui.item.id;
                        if(id) {
                            window.location = '/profile.php?id=' + id;
                        }
                    }
                    //source: [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ]
                });
            });
        </script>
    <?php
}
?>

<?php
    if(isset($scripts)) {
        echo $scripts;
    }
?>


<?php
//    $alerts = new_alert($db, $_SESSION['user']);
//    if($alerts) {
//       ?>
<!--            <script>-->
<!--                var alerts = JSON.parse('--><?//= $alerts ?>//');
//                for(item in alerts) {
//                    alert(alerts[item].text);
//                }
//            </script>
//       <?php
//            clear_user_alerts($db, $_SESSION['user']);
//    }
?>
</body>
</html>
