const generateToken = $.ajax({
            url: 'https://apicon-rkas.kemdikbud.go.id/token',
            method: 'post',
            headers: {
                "Accept": "application/x-www-form-urlencoded",
            },
            data: {
                userName: 'itjen@kemdikbud.go.id',
                password: 'A0889E7BBA8A43249261C51B2AABAAA5',
                grant_type: 'password'
            },
            success: function(res) {
                return res;
            },
            error: function(err) {
                console.log(err);
            }
        }).done(function() {
            $('.loader').remove();
            $('form').removeClass('hide');
        });