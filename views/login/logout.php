<h4 class="mt-5 text-center">
    <span><?=__('wait_logout')?></span>
</h4>
<script>
    $(document).ready(function(){
        Storage.clear();
        setTimeout(function () {
            window.location.href = base_url + '/login'
        },1500)
    })
</script>