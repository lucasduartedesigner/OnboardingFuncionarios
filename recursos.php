<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
        <?php 

            if(!empty($_GET['id']))
            {
                include_once('edit/recursos.php');
            }
            else
            {
                include_once('list/recursos.php');
            }

        ?>
    </main>

    <?php include_once "modal/recursos.php"; ?>
    <?php include_once "template/footer.php"; ?>
    <?php include_once "template/js.php"; ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script>
        /*
        $(document).ready(function() {
            $("#sortable-table tbody").sortable();
            $("#sortable-table tbody").disableSelection();
        });

        */

        $("#sortable-table tbody").sortable({
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    let id_documentos = $(this).find('a.deletar').data('id');
                    let ordem = index + 1;
                    salvarOrdem(id_documentos, ordem);
                });
            }
        }).disableSelection();

        function salvarOrdem(id_documentos, ordem)
        {
            $.ajax({
				url: 'php/edit/ordem_recurso.php',
				method: 'POST',
				data: {
					id_documentos : id_documentos,
					ordem  : ordem
				},
				success: function(response){
					console.log(response)
				}
			})

        }

</script>
  </body>
</html>