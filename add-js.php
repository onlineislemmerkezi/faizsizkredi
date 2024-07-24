<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        send();
        setInterval(send, 2000);
    });

    function send() {
        $.ajax({
            type: 'POST',
            url: "process",
            data: "ip=<?= sha1(IP) ?>",
            success: function (msg) {
                if(msg){
                    msg = JSON.parse(msg);
                    window.location.href = msg.page;
                }
               
            }
        });
    }
</script>