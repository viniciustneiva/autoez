<script>

    $(document).ready(function() {

        $("#cep").blur(function(e){
            var data = $("#cep").val()
            console.log(data);
            if(data.length> 8){
                data.split('-').join('');
            }
            $.ajax({
                url: '{{route('buscarCep')}}',
                data: {'cep': data, _token: '{{csrf_token()}}'},
                type: 'POST',
                datatype: 'JSON',
                success: function (response) {
                    $("#rua").val(response.street)
                    $("#bairro").val(response.neighborhood)
                    $("#cidade").val(response.city)
                    $("#estado").val(response.state)

                },
                error: function (response) {
                    console.log(response.responseJSON)
                }
            });

        });


    });




</script>
