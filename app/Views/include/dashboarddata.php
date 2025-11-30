<script type="text/javascript">
$(document).ready(function() {
    $('#student-search').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?= base_url('search-student') ?>",
                type: 'GET',
                dataType: "json",
                data: {
                    query: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.student_firstname + ' ' + item
                                .student_lastname + ' ' + item
                                .student_surname,
                            value: item.student_code
                        };
                    }));
                }
            });
        },
        minLength: 2
    });
});
</script>
<!-- get dashboard analytics -->
<?php if (isset($fees) && isset($recettes) && isset($depenses)): ?>
<script defer>
//statistiques de traitement de demandes de visas par mois
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre",
            "Octobre", "Novembre", "Decembre"
        ],
        //Passeports recus
        datasets: [{
                label: '# PERCEPTION FRAIS',
                data: [<?= $fees[0]; ?>, <?= $fees[1]; ?>, <?= $fees[2]; ?>,
                    <?= $fees[3]; ?>,
                    <?= $fees[4]; ?>, <?= $fees[5]; ?>, <?= $fees[6]; ?>,
                    <?= $fees[7]; ?>,
                    <?= $fees[8]; ?>, <?= $fees[9]; ?>, <?= $fees[10]; ?>,
                    <?= $fees[11]; ?>
                ],
                backgroundColor: [
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                ],
                borderColor: [
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                ],
                borderWidth: 1
            },

            {
                label: '# AUTRES RECETTES',
                data: [<?= $recettes[0]; ?>, <?= $recettes[1]; ?>, <?= $recettes[2]; ?>,
                    <?= $recettes[3]; ?>,
                    <?= $recettes[4]; ?>, <?= $recettes[5]; ?>, <?= $recettes[6]; ?>,
                    <?= $recettes[7]; ?>,
                    <?= $recettes[8]; ?>, <?= $recettes[9]; ?>, <?= $recettes[10]; ?>,
                    <?= $recettes[11]; ?>
                ],
                backgroundColor: [
                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',
                ],
                borderColor: [
                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                    'rgba(0, 200, 81)', 'rgba(0, 200, 81)',
                ],
                borderWidth: 1
            },
            {
                label: '# DEPENSES',
                data: [<?= $depenses[0]; ?>, <?= $depenses[1]; ?>, <?= $depenses[2]; ?>,
                    <?= $depenses[3]; ?>,
                    <?= $depenses[4]; ?>, <?= $depenses[5]; ?>, <?= $depenses[6]; ?>,
                    <?= $depenses[7]; ?>,
                    <?= $depenses[8]; ?>, <?= $depenses[9]; ?>, <?= $depenses[10]; ?>,
                    <?= $depenses[11]; ?>
                ],
                backgroundColor: [
                    'rgb(255, 90, 94)',
                    'rgb(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',

                    'rgb(255, 90, 94)',
                    'rgb(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)'
                ],
                borderColor: [
                    'rgb(255, 90, 94)',
                    'rgb(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',

                    'rgb(255, 90, 94)',
                    'rgb(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)',
                    'rgba(255, 90, 94)'
                ],
                borderWidth: 1
            },
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<?php endif; ?>