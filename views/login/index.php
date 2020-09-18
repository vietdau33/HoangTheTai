<div id="formLogin">
    <div class="form-group image_head">
        <div class="row">
            <div class="col-6 text-center">
                <img src="<?=PUBLIC_URL?>images/copy_trading.png" alt="" class="w-75">
            </div>
            <div class="col-6 text-center">
                <img src="<?=PUBLIC_URL?>images/mib_system.png" alt="" class="w-50">
            </div>
        </div>
    </div>
    <?php if(isset($message)) : ?>
        <div class="mb-4 alert alert-<?=$type ?? 'warning'?>" role="alert">
            <?=$message?>
        </div>
    <?php endif; ?>
    <div class="form-group mt-4">
        <label for="username"><?=__('username_input')?></label>
        <input type="text" id="username" class="input-login" name="username" title="<?=__('username_input')?>" placeholder="<?=__('username_input')?>...">
    </div>
    <div class="form-group">
        <label for="password"><?=__('password_input')?></label>
        <input type="password" id="password" class="input-login" name="password" title="<?=__('password_input')?>" placeholder="<?=__('password_input')?>...">
    </div>
    <div class="form-group">
        <input type="checkbox" id="remember-me" class="d-none"/>
        <label for="remember-me" class="label-remember-me"><?=__('remember_me')?></label>
    </div>
    <button class="btn-custom" id="btnSubmitLogin"><?=__('login')?></button>
</div>

<script>
    $(document).ready(function(){
        var token = Storage.getItems(true).token;
        if(typeof token != 'undefined' && token != ''){
            _ajax(base_url + '/login/remember', {'token' : token}, function(result){
                if(result.status == '1'){
                    window.location.href = result.url;
                }else{
                    Storage.clear();
                }
            })
        }
        $('input[name=password]').on('keyup', function(e){
            if(e.keyCode == 13){
                $("#btnSubmitLogin").click();
            }
        })
        $("#btnSubmitLogin").click(function(){
            var username = $('input[name=username]').val().trim();
            var password = $('input[name=password]').val().trim();
            var remember = $("#remember-me").prop('checked');
            if(username == ''){
                alertify.error('<?=__('username_empty')?>');
                $('input[name=username]').css({'border-color' : 'red'}).one('focus', function(){
                    $(this).css({'border-color': ''})
                })
                return false;
            }
            if(password == ''){
                alertify.error('<?=__('password_empty')?>');
                $('input[name=password]').css({'border-color' : 'red'}).one('focus', function(){
                    $(this).css({'border-color': ''})
                })
                return false;
            }
            var params = {
                username : username,
                password : password,
                remember : remember ? '1' : '0'
            };
            _ajax(base_url + '/login/check_login', params, function(result){
                if(result.code == 200){
                    window.location.href = result.url;
                    Storage.setItems({'token' : result.token})
                    return true;
                }
                $('input[name=password]').val('');
                $("#remember-me").prop('checked', false);
                $('input[name=username]').focus();
                if(result.code == 310){
                    alertify.alert('Notification', result.message);
                    return false;
                }
                alertify.error(result.message);
                return false;
            })
        })
    })
</script>