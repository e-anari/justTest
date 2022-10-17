<div class="x_content">
    <br>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="comment">Comment <span
                    class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <textarea rows="10" cols="80" name="comment" required
                    class="form-control">{{old('comment',$comment->comment)}}</textarea>
                <br>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-9 col-sm-9  offset-md-3">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>

</div>