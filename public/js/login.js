$(function()
{
    $("input[name$='usuario']").on("blur",function()
    {
        veryiniciosession();
    });
    $("input[name$='clave']").on("blur",function()
    {
        veryiniciosession();
    });

    $("#login").on('submit',function()
    {
        veryiniciosession();
        loadajax();
        setTimeout(function()
        {
            $.ajax({
                type: $("#login").attr('method'),
                url:  $("#login").attr('action'),
                data: $("#login").serialize(),
                async: false,
                cache: false,
                dataType: "json",
                success: function(data)
                {
                    if(data.success == true)
                    {
                         window.location = data.mensages;
                    } 
                    else 
                    {
                        $("#msj_alert").html(data.mensages);
                    }
                },
            });
        },200);
        return false;
    });
});

function changecaptcha()
{
    $.ajax({
        type: "POST",
        url: base_url + "principal/new_captcha",
        cache: false,
        async: false,
        dataType: "json",
        success: function(data)
        {
            $("#img-captcha").html(data.image);
            $("input[name$='captcha']").val("");
            $("input[name$='captcha']").focus();
        }
    });
}

function veryiniciosession()
{
    $.ajax({
        type: 'POST',
        url: base_url + 'login/veryiniciosession',
        async: false,
        cache: false,
        success: function(data)
        {
            if(data == 1)
            {
                window.location = base_url + 'admin';
            }
        },
    });
}


