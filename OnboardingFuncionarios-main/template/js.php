<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

    $(document).ready(function () {

        $("form").submit(function(e){

            e.preventDefault();

            var type  = $(this).attr('method')
            var url   = $(this).attr('action')
            var dados = $(this).serialize()

            $.ajax({
                type: type,
                url: url,
                data: dados
            }).done(function(response) {

                if(response == "") 
                {
                    location.reload();
                } 
                else 
                {
                   bootbox.alert('<h4 class="text-center">'+response+'</h4>');
                }
            });

        });
    });

</script>