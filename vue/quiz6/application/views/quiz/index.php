<div id="quiz"></div>
<script type="text/javascript">
    $.ajax({
        url: '<?= base_url('quiz/ambildata') ?>',
        dataType: 'json',
        success: function(nafi) {
            console.log(nafi);
            var baris = '';
            for (var i = 0; i < nafi.length; i++) {
                baris += '<div clas="card"><p>' + nafi[i].soal + '</p></div>';
            }
            $('#quiz').html(baris);
        }
    })
</script>