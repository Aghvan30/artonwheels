$(document).ready(function () {

    var CSRF_TOKEN = $('[name="csrf-token"]').attr('content');

    $('.delete').click(function () {
        let c = confirm('deleted jjjj')
        if (c) {
            $url = $(this).next('[name=url]').val();
            if ($url.includes('destroy')) {
                $(this).parent().submit();
            } else {
                $_id = $(this).prev('[name=_id]').val();
//todo jnjel verjum
                $.ajax({
                    url: '/backend/' + $url,
                    type: 'POST',
                    context: {element: $(this)},
                    data: {_token: CSRF_TOKEN, id: $_id},
                    dataType: 'JSON',
                    success: function (data) {
                        if (data) {
                            alert("ays menun uni chalder duq cheq akox jnjel ayn ete uzum eq jnjel jnjeq childery naxapes")
                            // swal.fire(_swal.delete).then((result) => {
                            //     if (result.value) {
                            //
                            //         if ($('[name=removed]').val() == 0)
                            //             $('[name=removed]').val('1');
                            //         this.element.parent().submit();
                            //     }
                            // });
                        } else {
                            this.element.parent().submit();
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        }
    });
    $('.close').click(function () {
        let c = confirm('deleted close')
        if (c) {
            $url = $('[name=url]').val();
            $_id = $('[name=_id]').val();
            $img = $(this).parent().next('[name=img]').val();


            $.ajax({
                url: '/backend/' + $url,
                type: 'POST',
                context: {element: $(this)},
                data: {_token: CSRF_TOKEN, id: $_id, img: $img},
                dataType: 'JSON',
                success: function (data) {
                    if (data.msg == 'ok') {
                        location.reload();
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    })
    $('.close_st').click(function () {
        let c = confirm('deleted st')
        if (c) {
            $url = $('[name=url_st]').val();
            $_id = $('[name=route_id]').val();
            $arr_id = $(this).parent().next('[name=arr_id]').val();


            $.ajax({
                url: '/backend/' + $url,
                type: 'POST',
                context: {element: $(this)},
                data: {_token: CSRF_TOKEN, id: $_id, arr_id: $arr_id},
                dataType: 'JSON',
                success: function (data) {
                    if (data.msg == 'ok') {
                        location.reload();
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    })
    $('.close_img').click(function () {
        let c = confirm('deleted img')
        if (c) {
            $url = $('[name=url]').val();
            $_id = $('[name=_id]').val();
            $.ajax({
                url: '/backend/' + $url,
                type: 'POST',
                context: {element: $(this)},
                data: {_token: CSRF_TOKEN, id: $_id},
                dataType: 'JSON',
                success: function (data) {
                    if (data.msg == 'ok') {
                        location.reload();
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    })
    $('#route').change(function () {
        let d = $(this).val();

        if (d) {
            $url = $('[name=url]').val();

            $.ajax({
                url: '/backend/' + $url,
                type: 'POST',
                context: {element: $(this)},
                data: {_token: CSRF_TOKEN, id: d},
                dataType: 'JSON',
                success: function (data) {

                    if (data) {
                        let ri = $('.route_info');
                        ri.html("");
                        ri.append(`<h1>${data.data.title}</h1>`);
                        let stations = JSON.parse(data.data.stations);
                        ri.append(`<ul class="station_name"></ul>`);
                        let step = 0;
                        for (let i of stations) {
                            $('.station_name').append(`<li>
<a href="/backend/stations/addstation/${this.element.val()}/${step}">
${i.name}
<img src="/storage/upload/${i.img_name}" width="150">
</a>
</li>`)
                            step++;
                        }
                        ri.append(`<img src="/storage/upload/${data.data.image}" class="general">`);

                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    });

    var url = window.location;
    var element = $('ul.nav-sidebar a').filter(function () {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active');
    if (element.is('li')) {
        element.addClass('active').parent().parent('li').addClass('active')
    }

    $(function () {
        $(".lat").on("click", function (event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            $('#x').val(x);
            $('#lang').val(x);
            $('#y').val(y);
            $('#lat').val(y);
        });
    });
});
