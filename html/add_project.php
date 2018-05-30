<div class="content-wrapper">
    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add project page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form id="demo-form2" action='/projects.php?action=add' method='post' data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input value="<?= $name ?>" type="text" id="first-name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="last-name" name="description" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Research start date</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="start-date" class="date-masked form-control col-md-7 col-xs-12" type="text" name="start_date">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Research end date</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="end-date" class="date-masked form-control col-md-7 col-xs-12" type="text" name="end_date">
                            </div>
                          </div>
                          <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <a class="btn btn-primary" href="/index.php" type="button">Cancel</a>
                              <button class="btn btn-primary" type="reset">Reset</button>
                              <button type="submit" class="btn btn-success">Publish</button>
                            </div>
                          </div>
                    </form>
              </div>
            </div>
      </div>
</div>