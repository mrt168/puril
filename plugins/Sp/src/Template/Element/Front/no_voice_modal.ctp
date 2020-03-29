<style type="text/css">
    /*ポップアップここから*/
    .popup_wrap input {
        display: none;
    }

    .popup_overlay {
        display: flex;
        justify-content: center;
        overflow: auto;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        opacity: 0;
        transition: opacity 0.5s, transform 0s 0.5s;
        transform: scale(0);
    }

    .popup_trigger {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .popup_content {
        position: relative;
        align-self: center;
        width: 90%;
        max-width: 800px;
        padding: 30px 30px 15px;
        box-sizing: border-box;
        background: #fff;
        line-height: 1.4em;
        transition: 0.5s;
    }

    .close_btn {
        position: absolute;
        top: 14px;
        right: 16px;
        font-size: 30px;
        cursor: pointer;
    }

    .popup_overlay.on {
        opacity: 1;
        transform: scale(1);
        transition: opacity 0.5s;
    }

    .open_btn {
        position: relative;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 200px;
        height: 30px;
        margin:10px auto;
        padding: 8px 16px;
        color: #fff;
        background:#0c0d62;
        font-weight: bold;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
        border-radius: 3px;
        cursor: pointer;
        transition: .3s ease;

    }
    .open_btn:hover{
        background:#000;
        color:#fff;
        transition: .3s ease;
    }
    .popup_content_img {
        margin: 0 auto;
        display: block;
    }
    .no-link {
    }
    /*ポップアップココまで*/
</style>
<div class="popup_wrap">
    <div class="popup_overlay">
        <label for="trigger" class="popup_trigger"></label>
        <div class="popup_content" for="trigger">
            <label for="trigger" class="close_btn">×</label>
            <p><img src="/puril/images/img/popup.png" class="popup_content_img" alt=""></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.no-link').on('click',function(e){
            e.preventDefault()
            $(".popup_overlay").addClass("on");
        });
        $(".popup_overlay").click(function(){
            $(".popup_overlay").removeClass("on");
        });
    });
</script>