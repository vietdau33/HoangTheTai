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
        <div class="mb-4" style="color: rgba(0,204,255,1)" role="alert">
            <?=$message?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="input-login" id="username" name="username" title="<?=__('username_input')?>" value="<?=(new Session('logined'))->get('username')?>" disabled>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="input-login" id="password" name="password" title="<?=__('password_input')?>" placeholder="<?=__('new_password')?>...">
    </div>
    <div class="form-group">
        <label for="re_password">Confirm Password</label>
        <input type="password" class="input-login" id="re_password" title="<?=__('password_input')?>" placeholder="<?=__('new_password')?>...">
    </div>
    <button class="button-submit btn-custom text-uppercase" id="btnChangePassword">Save & login</button>
</div>

<script>
    $(document).ready(function(){
        $('input[name=password]').on('keyup', function(e){
            if(e.keyCode == 13){
                $("#btnChangePassword").click();
            }
        })
        $("#btnChangePassword").click(function(){
            var password = $('input[name=password]').val().trim();
            var re_password = $('input[id=re_password]').val().trim();
            if(password == ''){
                alertify.error('<?=__('password_empty')?>');
                $('input[name=password]').css({'border-color' : 'red'}).one('focus', function(){
                    $(this).css({'border-color': ''})
                })
                $("#re_password").val('');
                return false;
            }
            if(re_password == ''){
                alertify.error('<?=__('password_empty')?>');
                $('input[id=re_password]').css({'border-color' : 'red'}).one('focus', function(){
                    $(this).css({'border-color': ''})
                })
                return false;
            }
            if(password != re_password){
                alertify.error('The password is not the same');
                $('input[name=password]').focus();
                return false;
            }
            var params = {
                password : password,
                type : 'first'
            };
            _ajax(base_url + '/member/change_password', params, function(result){
                if(result.code == 200){
                    window.location.reload();
                    return true;
                }
                alertify.alert(result.message).set({'title' : 'Notification'});
                $('input[name=password]').val('');
                return false;
            })
        })
    })
</script>