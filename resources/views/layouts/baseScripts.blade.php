{{-- jQuery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- jQuery UI --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- jQuery Mask --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- jQuery Typeahead --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js" integrity="sha512-Rc24PGD2NTEGNYG/EMB+jcFpAltU9svgPcG/73l1/5M6is6gu3Vo1uVqyaNWf/sXfKyI0l240iwX9wpm6HE/Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.css" integrity="sha512-7zxVEuWHAdIkT2LGR5zvHH7YagzJwzAurFyRb1lTaLLhzoPfcx3qubMGz+KffqPCj2nmfIEW+rNFi++c9jIkxw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- FontAwesome --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- jQuery MaskMoney --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        let $cpf = $("#cpf");
        let $cep = $("#cep");
        let $telefone = $("#telefone");
        $cep.mask('00000-000', {reverse: true});
        $cpf.mask('000.000.000-00', {reverse: true});
        $telefone.mask('(00) 0 0000-0000');
        $(".showPassword").click(function (){
            let botao = $(".showPassword")
            let inputSenha = $("#password");
            if(inputSenha.attr('type') === 'password'){
                botao.html('<i class="fa-solid fa-eye-slash"></i>');
                document.getElementsByName("password")[0].type="text";
                inputSenha.attr('type').val('text');
            }else{
                botao.html('<i class="fas fa-eye"></i>');
                document.getElementsByName("password")[0].type="password";
            }

        })

        $('input[name=placa]').mask('AAA 0U00', {
            translation: {
                'A': {
                    pattern: /[A-Za-z]/
                },
                'U': {
                    pattern: /[A-Za-z0-9]/
                },
            },
            onKeyPress: function (value, e, field, options) {
                // Convert to uppercase
                e.currentTarget.value = value.toUpperCase();

                // Get only valid characters
                let val = value.replace(/[^\w]/g, '');

                // Detect plate format
                let isNumeric = !isNaN(parseFloat(val[4])) && isFinite(val[4]);
                let mask = 'AAA 0U00';
                if(val.length > 4 && isNumeric) {
                    mask = 'AAA-0000';
                }
                $(field).mask(mask, options);
            }
        });



    });

    $(function(){
        $('#valor').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
        //$('.td_valor').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});

    })

    $(".close.btn").click(function (e) {
        $("#alert-message").toggleClass('d-none');
    });

    $('#close-modal').click(function () {
       $('.modal-fullscreen').toggleClass('oculto');
    });






</script>
