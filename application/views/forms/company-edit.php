<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Edit Company Detail</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('companies/edit/'.$company['id']); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="<?php echo $company['name']; ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Short Name</label>
                        <div class="col-md-6">
                            <input type="text" name="short_name" class="form-control" value="<?php echo $company['short_name']; ?>">
                            <div class="validation_error"><?php echo form_error('short_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo $company['description']; ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Unit Number</label>
                        <div class="col-md-6">
                            <input type="text" name="unit_number" class="form-control" value="<?php echo $company_address['unit_number']; ?>">
                            <div class="validation_error"><?php echo form_error('unit_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Floor Number</label>
                        <div class="col-md-6">
                            <input type="text" name="floor_number" class="form-control" value="<?php echo $company_address['floor_number']; ?>">
                            <div class="validation_error"><?php echo form_error('floor_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Building Number</label>
                        <div class="col-md-6">
                            <input type="text" name="building_number" class="form-control" value="<?php echo $company_address['building_number']; ?>">
                            <div class="validation_error"><?php echo form_error('building_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Building Name</label>
                        <div class="col-md-6">
                            <input type="text" name="building_name" class="form-control" value="<?php echo $company_address['building_name']; ?>">
                            <div class="validation_error"><?php echo form_error('building_name'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Block Number</label>
                        <div class="col-md-6">
                            <input type="text" name="block_number" class="form-control" value="<?php echo $company_address['block_number']; ?>">
                            <div class="validation_error"><?php echo form_error('block_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Lot Number</label>
                        <div class="col-md-6">
                            <input type="text" name="lot_number" class="form-control" value="<?php echo $company_address['lot_number']; ?>">
                            <div class="validation_error"><?php echo form_error('lot_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Street</label>
                        <div class="col-md-6">
                            <input type="text" name="street" class="form-control" value="<?php echo $company_address['street']; ?>">
                            <div class="validation_error"><?php echo form_error('street'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Telephone Number</label>
                        <div class="col-md-6">
                            <input type="text" name="telephone_number" class="form-control" value="<?php echo $company_contact['telephone_number']; ?>">
                            <div class="validation_error"><?php echo form_error('telephone_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mobile Number</label>
                        <div class="col-md-6">
                            <input type="text" name="mobile_number" class="form-control" value="<?php echo $company_contact['mobile_number']; ?>">
                            <div class="validation_error"><?php echo form_error('mobile_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fax Number</label>
                        <div class="col-md-6">
                            <input type="text" name="fax_number" class="form-control" value="<?php echo $company_contact['fax_number']; ?>">
                            <div class="validation_error"><?php echo form_error('fax_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email Address</label>
                        <div class="col-md-6">
                            <input type="text" name="email" class="form-control" value="<?php echo $company_contact['email']; ?>">
                            <div class="validation_error"><?php echo form_error('email'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label">Website</label>
                        <div class="col-md-6">
                            <input type="text" name="website" class="form-control" value="<?php echo $company_contact['website']; ?>">
                            <div class="validation_error"><?php echo form_error('website'); ?></div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">RDO</label>
                        <div class="col-md-6">
                            <select class="form-control select2 col-xs-3 col-md-3 col-sm-3 col-lg-3" name="revenue_district_office_id" id="revenue_district_office_id">
                                <option value="<?php echo $company_govt_number['revenue_district_office_id']; ?>"><?php echo $company_govt_number['revenue_district_office']; ?></option>
                                <option value="">-- Select Revenue District Office --</option>
                                <?php foreach ($rdos as $rdo): ?>
                                    <option value="<?php echo $rdo['id']; ?>"><?php echo $rdo['rdo_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="validation_error"><?php echo form_error('revenue_district_office_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">TIN</label>
                        <div class="col-md-6">
                            <input type="text" name="tin" class="form-control" value="<?php echo $company_govt_number['tin']; ?>">
                            <div class="validation_error"><?php echo form_error('tin'); ?></div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">SSS</label>
                        <div class="col-md-6">
                            <input type="text" name="sss" class="form-control" value="<?php echo $company_govt_number['sss']; ?>">
                            <div class="validation_error"><?php echo form_error('sss'); ?></div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">HDMF</label>
                        <div class="col-md-6">
                            <input type="text" name="hdmf" class="form-control" value="<?php echo $company_govt_number['hdmf']; ?>">
                            <div class="validation_error"><?php echo form_error('hdmf'); ?></div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">PHIC</label>
                        <div class="col-md-6">
                            <input type="text" name="phic" class="form-control" value="<?php echo $company_govt_number['phic']; ?>">
                            <div class="validation_error"><?php echo form_error('phic'); ?></div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Business Registration Number</label>
                        <div class="col-md-6">
                            <input type="text" name="business_registration_number" class="form-control" value="<?php echo $company_govt_number['business_registration_number']; ?>">
                            <div class="validation_error"><?php echo form_error('business_registration_number'); ?></div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
