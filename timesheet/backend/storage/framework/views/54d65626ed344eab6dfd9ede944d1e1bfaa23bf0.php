<button type="button" class="btn btn-sm btn-default form_attr_more1" onclick="$('.form_attr_more1').toggle();">
    More <i class="fa fa-chevron-down"></i>
</button>
<button type="button" class="btn btn-sm btn-default form_attr_more1" onclick="$('.form_attr_more1').toggle();" style="display: none;">
    More <i class="fa fa-chevron-up"></i>
</button>
<div class=" form_attr_more1" style="display: none;">
    <hr>
    <div class="row">
        <div class="col-sm-3">
            <label>Created By</label>
            <div>{{h.created_by}}</div>
        </div>
        <div class="col-sm-3">
            <label>Created At</label>
            <div>{{h.created_at}}</div>
        </div>
        <div class="col-sm-3">
            <label>Updated At</label>
            <div>{{h.updated_at}}</div>
        </div>
        <div class="col-sm-3">
            <label>Deleted At</label>
            <div>{{h.deleted_at}}</div>
        </div>
    </div>
    <hr>
</div><?php /**PATH C:\xampp\htdocs\me\smart\smart_back\resources\views/layouts/common/coloradmin/form_attr.blade.php ENDPATH**/ ?>