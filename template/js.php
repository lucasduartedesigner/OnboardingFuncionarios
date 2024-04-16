<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>

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
                    Swal.fire({
                      title: response,
                      showDenyButton: false,
                      showCancelButton: false,
                      confirmButtonText: "Ok",
                    }).then((result) => {
                      if (result.isConfirmed) 
                      {
                        location.reload();
                      }
                    });

                }
            });

        });
    });

    $(document).on('click', '.deletar', function(event){

        var nome  = $(this).attr('data-nome');
        var id    = $(this).attr('data-id');
        var table = $(this).attr('data-table');

        Swal.fire({
          title: 'Deseja deletar ' +  nome + '?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: "Confirmar",
          cancelButtonText: "Cancelar",
        }).then((result) => {

          if (result.isConfirmed) 
          {
            deletar(table, id);
          }

        });

        return false;
    });

    function deletar(table, id)
    {
        $.ajax({
            type: 'POST',
            url: 'php/delete/delete.php',
            data: { table : table, id : id }
        }).done(function(response) {
            location.reload();
        });
    }

</script>