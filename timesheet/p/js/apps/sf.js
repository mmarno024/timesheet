$.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
    var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

    if (token) {
        return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
    }
});
var blue = '#348fe2',
    blueLight = '#5da5e8',
    blueDark = '#1993E4',
    aqua = '#49b6d6',
    aquaLight = '#6dc5de',
    aquaDark = '#3a92ab',
    green = '#00acac',
    greenLight = '#33bdbd',
    greenDark = '#008a8a',
    orange = '#f59c1a',
    orangeLight = '#f7b048',
    orangeDark = '#c47d15',
    dark = '#2d353c',
    grey = '#b6c2c9',
    purple = '#727cb6',
    purpleLight = '#8e96c5',
    purpleDark = '#5b6392',
    red = '#ff5b57';

function SfFormNew(selector) {
    $(selector + " .textError").removeClass("textError");
}

function SfFormValidate(selector, classIfError) {
    if (classIfError === undefined || classIfError == '') {
        classIfError = 'textError';
    }
    $(selector + " .textError").removeClass("textError");
    var cek = true;
    var x = $(selector + " :required");
    x.each(function(index) {
        if ($(x[index]).val().trim() === "") {
            cek = false;
            $(x[index]).addClass("textError");
        }
    });
    return cek;
}

function SfExportExcel(id) {
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#' + id).html()));
}

function toggleFullscreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}

function SfAjaxPager(selector, fn) {
    $(selector + ' .pagination a').on('click', function(event) {
        event.preventDefault();
        if ($(this).attr('href') != '#') {
            $(selector).load($(this).attr('href'), function() {
                SfAjaxPager(selector, fn);
            });
        }
    });
    if (fn) fn();
}

function SfDialog(id, caption, size, fn) {
    /**
    contoh pakai :
    SfDialog("symenu", "Cari Menu", "modal-sm", function(){
                    $("#sfdialog-symenu .modal-body").html('test body');
                });
    **/

    var htmlDialog =
        `<div class="modal" id="` + id + `" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog  ` + (size == '' ? 'modal-lg' : size) + `" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                    <h4 class="modal-title text-navy" id="myModalLabel">` + caption + `
                        <small class=" subtitle">
                        </small>
                    </h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#` + id + `").modal('show');
    });
    </script>
    `;
    if (!$("#sfdialog-" + id).length) {
        $("body").append("<div id='" + "sfdialog-" + id + "'></div>");
    }
    $("#sfdialog-" + id).html(htmlDialog);
    if (fn) fn();

    /*$.post(SfBaseUrl + "/system/dialog", { id: id, caption: caption, size: size }, function(data) {
        if (!$("#sfdialog-" + id).length) {
            $("body").append("<div id='" + "sfdialog-" + id + "'></div>");
        }
        $("#sfdialog-" + id).html(data);
        if (fn) fn();
    }).fail(function(request, status, error) {
        swal("", request.responseText, "error");
    });*/
}

function SfLookup(url, fn) {
    /**
    contoh pakai :
    <div class="input-group">
        <input id="parent" name="parent" type="text" class="form-control input-sm clear ">
        <span class="input-group-btn">
        <button type="button" class="btn btn-sm btn-default"  onclick="oLookup('parent','parent');"><i class="fa fa-search"></i></button>
        </span>
    </div>
    */
    var id = 'sflookup-d-' + url.replace(/[^a-z0-9]/gi, '');
    SfDialog(id, "Lookup Data", "modal-lg", function() {
        SfLookupSearch(id, url, fn);
    });
}

function SfLookupSearch(id, url, fn) {
    if (!$("#" + id + " .modal-body input.q-search").length) {
        var q = '';
    } else {
        var q = encodeURI($("#" + id + " .modal-body input.q-search").val());
    }
    if (url.indexOf("?") >= 0) {
        var opr = "&";
    } else {
        var opr = "?";
    }
    $("#" + id + " .modal-body").load(url + opr + "q=" + q, function(responseText, textStatus, req) {
        if (textStatus == "error") {
            $("#" + id + " .modal-body").html(responseText);
        }
        SfAjaxPager("#" + id + " .modal-body", function() {
            SfLookupEvent(id, url, fn)
        });
        // SfLookupEvent(id, url, fn);
    });
}

function SfLookupEvent(id, url, fn) {
    $("#" + id + " .modal-body input.q-search").on("keydown", function(e) {
        if (e.keyCode == 13)
            SfLookupSearch(id, url, fn);
    });
    $("#" + id + " .modal-body span button.btn-search").on("click", function(e) {
        SfLookupSearch(id, url, fn);
    });
    $("#" + id + " .modal-body table tr.onclicktrlookup").on('click', function() {
        if (fn) {
            var arrJson = JSON.parse($(this).attr('data-json'));
            fn($(this).attr('data-id'), $(this).attr('data-name'), arrJson);
            $("#" + id).modal('hide');
        }
    });
    $("#" + id + " .modal-body input.q-search").focus()
}

function SfLog(trs, doc_no) {
    SfDialog("seelog_", "Log : " + trs + " (" + doc_no + ")", "modal-lg", function() {
        SfSeeLog(SfBaseUrl + '/sys_sylog_seelog/' + trs + '/' + doc_no)
    });
}

function SfSeeLog(url, fn) {
    var $btn = $('button').button('loading');
    $.ajax({
        type: 'GET',
        url: url,
        beforeSend: function() {},
        success: function(data) {
            $btn.button('reset');
            // SfDialog('seelog_', "System Log", "modal-lg", function() {
            $("#seelog_ .modal-body").html(data);
            SfAjaxPager("#seelog_ .modal-body", function() {});
            // });
            if (fn) fn();
        },
        error: function(request, status, error) {
            $btn.button('reset');
            swal(error, request.responseText, 'error');
        }
    });
}

function SfSelectPlant(plant) {
    $.get(SfBaseUrl + "/select_plant_set/" + plant, {}, function(data) {
        location.reload();
    }).fail(function(request, status, error) {
        swal("", request.responseText, "error");
    });
}

function SfSetUserAttr(attr_id, attr_value) {
    $.get(SfBaseUrl + "/set_user_attr", { attr_id: attr_id, attr_value: attr_value }, function(data) {
        swal("", "Success", "success");
    }).fail(function(request, status, error) {
        swal("", request.responseText, "error");
    });
}

function SfGetMediaList(path, fn) {
    $.get(SfBaseUrl + "/libftp_list", { path: path }, function(jdata) {
        if (fn) fn(jdata);
    }).fail(function(request, status, error) {
        swal("", request.responseText, "error");
    });
}

function SfDelMedia(path, fn) {
    $.get(SfBaseUrl + "/libftp_del", { path: path }, function(jdata) {
        if (fn) fn(jdata);
    }).fail(function(request, status, error) {
        swal("", request.responseText, "error");
    });
}

function jsDate(strDate) {
    if (strDate == '0000-00-00') {
        return null;
    }
    return moment(strDate, 'YYYY-MM-DD').toDate();
};

function jsTime(strTime) {
    return moment(strTime, 'HH:mm:ss').toDate();
};

function SfNoBackward() {
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        history.go(1);
    };

}

function json2param(vjson) {
    var str = "";
    $.each(vjson, function(k, v) {
        str += "&" + k + "=" + encodeURI(v);
    })
    return str;
}