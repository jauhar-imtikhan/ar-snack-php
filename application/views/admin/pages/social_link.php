<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/social_link') ?>" aria-current="page">Sosial Media</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Sosial Media</h4>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-7">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" class="form-icons">
                    <div class="form-group">
                        <label for="sociallink">Sosial Media Link</label>
                        <input type="text" name="sociallink" id="sociallink" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="socialicon">Sosial Media Icon Atau <span id="uploadicons" style="text-decoration: underline; cursor: pointer; font-weight: bold;">UPLOAD</span></label>
                        <input type="text" name="socialicon" id="socialicon" class="form-control">
                    </div>
                    <input type="file" accept="image/png" style="display: none;" disabled name="icon" id="uploadicon">
                    <div class="form-group float-right">
                        <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-5">
        <style>
            .bo-icon-search {
                position: relative;
                width: 100%;
                height: 100%;
                border-radius: 5px;
                border: 1px solid rgba(245, 245, 245, 0.25);
                padding-top: 10px;
                padding-right: 10px;
                padding-left: 10px;
                padding-bottom: 0;
            }

            .icon-search {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .icon-search-field {
                border-radius: 4px;
                width: 100%;
                border: 1px solid rgba(206, 205, 205, 0.25);
                background-color: rgba(181, 176, 176, 0.25);
                color: whitesmoke;
                padding: 4px;

            }

            .icon-search-field:focus {
                outline: rgba(206, 205, 205, 0.25);
                border-color: rgba(206, 205, 205, 0.25);
                background-color: rgba(243, 238, 238, 0.25);
                padding: 6px;
                color: white;
            }

            .row .icon-search-result {
                overflow-y: scroll;
                overflow-x: hidden;
            }

            .icon-search-result::-webkit-scrollbar {
                display: none;
            }

            .bo-icon-result {
                background-color: rgba(253, 239, 246, 0.36);
                margin-top: 1rem;
                width: auto;
                max-width: fit-content;
                border-radius: 5px;
                padding: 10px;
                font-size: larger;
                display: flex;
                max-height: 4rem;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            }

            .bo-icon-result-text {
                color: white;
            }

            .bo-icon {
                font-size: 20px;
            }
        </style>
        <div class="card">
            <div class="card-body">
                <input type="text" name="" autofocus="on" placeholder="Cari Icon" id="searchIcon" class="form-control">
                <div class="row icon-search-result" style="overflow-x: scroll; max-height: 185px;" id="renderIcon">

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#uploadicons').hover(
            function() {
                // Saat elemen dihover
                $(this).css('color', 'rgba(111, 120, 244, 1)');
            },
            function() {
                // Saat elemen tidak dihover lagi
                $(this).css('color', '');
            }
        );

        $('#uploadicons').click(function() {
            $('#uploadicon').removeAttr('disabled')
            $('#uploadicon').click()
        })

        const debouceSearch = debounce(getIcon, 1000)
        $('#searchIcon').on('input', debouceSearch)

        $('.form-icons').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/social_media_link') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#submit').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                    }
                },
                complete: function() {
                    $('#submit').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })
    })

    function getIcon() {
        let keyword = $('#searchIcon').val();
        $.ajax({
            url: '<?= site_url('admin/get_icon/') ?>' + keyword,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                $('#renderIcon').empty();
                $.each(data, function(index, val) {
                    let element = `<div class="col-6 mt-3 d-flex" style="gap: 5px;">
                        <div class="card" style="cursor: pointer;" data-id="${val.icon_name}" onclick="setIcon(this)">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <i class="${val.icon_name} text-white bo-icon"></i>
                                <span class="text-center mt-2">${val.icon_name}</span>
                            </div>
                        </div>
                    </div>`;

                    $('#renderIcon').append(element);
                })
                if (data.length == 0) {
                    $('#renderIcon').html(`<div class="col-12 mt-3 text-center">
                    <span class="text-danger">Icon Tidak Ditemukan</span></div>`);
                }
            },
            error: function(err) {
                console.log(err);
            }
        })
    }

    function setIcon(name) {
        let icon = $(name).data('id')
        // console.log(icon);
        $('#socialicon').val(icon)
    }
</script>