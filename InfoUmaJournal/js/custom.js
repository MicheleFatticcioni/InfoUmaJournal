(function($) {
    $(document).ready(function() {
        console.log(obj.admin_url)
        $('#policy').change(function () {
            var input = document.getElementById('policy')
            console.log(input.checked)
            if(input.checked){
                $('#jobOffert').prop( "disabled", false );
            } else{
                $('#jobOffert').prop( "disabled", true );
            }
        });
        
        $('#jobOffert').click(function (e) { 
            e.preventDefault();
            var input = document.getElementsByClassName("form-control");
            let error = "";
            let listError = []
            let listRes = {};
            Object.keys(input).forEach((el, i) =>{
                let closestElement = input[i].closest('div');
                if(input[i].value === ""){
                    closestElement.classList.remove("valid")
                    closestElement.classList.add("invalid");
                    error += "<p>"+input[i].id +"</p>";
                    if(input[i].dataset.required === 'required'){
                        listError[input[i].id] = input[i].value;
                    }
                } else{
                    console.log('dentro else');
                    closestElement.classList.remove("invalid")
                    closestElement.classList.add("valid");
                    listError.splice(listError[input[i].id])
                    if(!(input[i].id in listRes)){
                        listRes[input[i].id] = input[i].value
                    } else{
                    }
                }
            })

            Object.keys(listError).length
            if(Object.keys(listError).length > 0 && listError.length === 0){
                console.log("ci sono errori")
                console.log(listError);
            } else{
                document.getElementById("formJob").reset();
                $.ajax({
                    type: "POST",
                    url: obj.admin_url,
                    data: {
                        action : 'add_job_opportunity',
                        data : listRes
                    },
                    success: function (response) {
                        let message = 'Grazie per averci scritto, la tua richiesta è in revisione!'
                        $('.form-response p').html(message) 
                        $('.form-response').addClass('show') 
                    }
                });
            }
        });
    })
})(jQuery);
