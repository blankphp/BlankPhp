<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="referrer" content="never">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $this->getValue($this->_config['name']); ?> - <?php $this->getValue($this->_config['title']); ?></title>
    <meta name="keywords" content="<?php $this->getValue($this->_config['keywords']); ?>"/>
    <meta name="description" content="<?php $this->getValue($this->_config['description']); ?>"/>
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="./Assets/css/main.css" rel="stylesheet">
</head>
<body background="https://ws3.sinaimg.in/large/0072Vf1pgy1foxloenfpzj31kw0w0hb5.jpg">
<div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block text-center" style="float: none;">
        <div class="panel panel-default">
            <div class="panel-heading"><?php $this->getValue($this->_config['name']); ?>〃'▽'〃<a id="jsl_speed_stat1"
                                                                  href="http://www.yunaq.com/#zid=5ccd4ef3796db47f0f383bef"
                                                                  target="_blank">知道创宇云安全</a>
                <script src="//static.yunaq.com/static/js/stat/picture1_stat.js" charset="utf-8"
                        type="text/javascript"></script>
                </font></div>
            <div class="panel-body text-center" align="center">
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php $this->getValue($this->_config['zzqq']); ?>&site=qq&menu=yes">
                    <img class="img-circle m-b-xs" width="100" style="border: 2px solid skyblue;"
                         src="<?php $this->getValue($this->_config['tou']); ?>" alt="<?php $this->getValue($this->_config['title']); ?>">
                </a>
                <p><font color="info">高速外链，全球CDN加速，支持最多20张图片同时上传！</font>
                <p/>
                <form enctype="multipart/form-data">
                    <button type="button" onclick="file.click();" class="btn btn-default btn-sm"
                            id="toUploaded"></button>
                    <input type="file" name="file" id="file" style="display:none" accept="image/*" multiple="multiple"/>
                    <p>
                        <label><input name="type" type="radio" value="local" checked>Local </label>
<!--                        <label><input name="type" type="radio" value="sina" >新浪 </label>-->
<!--                        <label><input name="type" type="radio" value="sougo">搜狗 </label>-->
<!--                        <label><input name="type" type="radio" value="smms">SMMS </label>-->
                    </p>
                    <input type="button" value="开始上传" class="btn btn-default" onclick="doUpload();">
                    <p id="image"></p>
                </form>
            </div>
            <div class="panel-footer text-center">
                <small><code id="hitokoto">(〃'▽'〃)获取中...</code></small>
            </div>
        </div>
    </div>
    <script src="//cdn.bootcss.com/jquery/2.1.3/jquery.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.bootcss.com/clipboard.js/1.7.1/clipboard.js"></script>
    <script src="//cdn.bootcss.com/layer/3.1.0/layer.js"></script>

    <script>
        var clipboard = new Clipboard(".copy-btn");
        clipboard.on("success", function (e) {
            layer.msg("复制成功")
        });
        clipboard.on("error", function (e) {
            layer.msg("复制失败，请长按链接后手动复制")
        });
        $(function () {
            $("#toUploaded").append("<span class='file_multiple'><span class='glyphicon glyphicon-cloud-upload'></span> 拖拽或选择您的图片到这里(ﾉﾟ▽ﾟ)ﾉ</span>");
            $('input[name="file"]').change(function (event) {
                var filePaths = $(this)[0].files;
                $(".file_multiple").remove();
                if (filePaths.length > 20) {
                    layer.alert("别贪心，一次最多选择20张图片喔ヾ(=･ω･=)o", {
                        closeBtn: 0,
                        maxWidth: 320,
                        title: "温馨提示 ♪(･ω･)ﾉ",
                        btn: ["知道了"]
                    }, function () {
                        window.location.href = "index.php"
                    })
                }
                $("#toUploaded").append("<span class='file_multiple'><span class='glyphicon glyphicon-check'></span> 您选择了" + filePaths.length + "个文件(/≧▽≦)/~</span>")
            })
        });

        function doUpload() {
            var formData = new FormData();
            var files = $("#file")[0].files;
            if (files.length == 0) {
                layer.alert("请选择文件后再操作！", {closeBtn: 0, maxWidth: 320, title: "温馨提示 ♪(･ω･)ﾉ", btn: ["知道了"]})
            }
            var flag = 0;
            for (var i = 0; i < files.length; i++) {
                formData.append("fileupload", files[i]);
                var ii = layer.msg("上传中，请稍等...", {icon: 16, shade: 0.1, time: false});
                var type = $('input:radio[name="type"]:checked').val();
                $.ajax({
                    url: "http://localhost/one/public/index.php/api/image?type=" + type,
                    type: "post",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    async: true,
                    dataType: "json",
                    success: function (data) {
                        flag++;
                        if (flag == files.length) {
                            layer.close(ii);
                            layer.msg("上传完成")
                        }
                        if (data.code == 0) {
                            $("#image").append("<br><input type='text' value='" + data.msg + '\'><a class="copy-btn btn btn-success btn-sm" data-clipboard-text="' + data.msg + '">一键复制</a><br>')
                        } else {
                            layer.close(ii);
                            layer.alert(data.msg, {closeBtn: 0, maxWidth: 320, title: "温馨提示 ♪(･ω･)ﾉ", btn: ["知道了"]})
                        }
                    }
                })
            }
        };!function (e, t, a) {
            function r() {
                for (var e = 0; e < s.length; e++) {
                    s[e].alpha <= 0 ? (t.body.removeChild(s[e].el), s.splice(e, 1)) : (s[e].y--, s[e].scale += 0.004, s[e].alpha -= 0.013, s[e].el.style.cssText = "left:" + s[e].x + "px;top:" + s[e].y + "px;opacity:" + s[e].alpha + ";transform:scale(" + s[e].scale + "," + s[e].scale + ") rotate(45deg);background:" + s[e].color + ";z-index:99999")
                }
                requestAnimationFrame(r)
            }

            function n() {
                var t = "function" == typeof e.onclick && e.onclick;
                e.onclick = function (e) {
                    t && t(), o(e)
                }
            }

            function o(e) {
                var a = t.createElement("div");
                a.className = "heart", s.push({
                    el: a,
                    x: e.clientX - 5,
                    y: e.clientY - 5,
                    scale: 1,
                    alpha: 1,
                    color: c()
                }), t.body.appendChild(a)
            }

            function i(e) {
                var a = t.createElement("style");
                a.type = "text/css";
                try {
                    a.appendChild(t.createTextNode(e))
                } catch (t) {
                    a.styleSheet.cssText = e
                }
                t.getElementsByTagName("head")[0].appendChild(a)
            }

            function c() {
                return "rgb(" + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + ")"
            }

            var s = [];
            e.requestAnimationFrame = e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || e.oRequestAnimationFrame || e.msRequestAnimationFrame || function (e) {
                setTimeout(e, 1000 / 60)
            }, i(".heart{width: 10px;height: 10px;position: fixed;background: #f00;transform: rotate(45deg);-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);}.heart:after,.heart:before{content: '';width: inherit;height: inherit;background: inherit;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;position: fixed;}.heart:after{top: -5px;}.heart:before{left: -5px;}"), n(), r()
        }(window, document);

    </script>

    <script >
        (function hitokoto(){var hitokoto="哈哈哈";var dom=document.querySelector('#hitokoto');Array.isArray(dom)?dom[0].innerText=hitokoto:dom.innerText=hitokoto;})()
    </script>

    <center>© <?php echo date("Y", time()); ?> <font color="red"><span class="glyphicon glyphicon-heart"></span></font><?php $this->getValue($this->_config['title']); ?>
    </center>
    <br>
    <div id="circle" style="opacity: 1;"></div>
    <div id="circletext" style="opacity: 1;"></div>
</body>
</html>