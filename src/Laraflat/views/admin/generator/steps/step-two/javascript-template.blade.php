<div class="column"><div class="row"><div class="col-lg-3">@include("laraflat::fileds.javascript.text" , ["name" => "name[]" , "label" => trans("laraflat::laraflat.Column")." ".trans("laraflat::laraflat.Name")])</div><div class="col-lg-3">@include("laraflat::fileds.javascript.select", ["name" => "column[]" , "array" => $migrationTypes , "label" => trans("laraflat::laraflat.Column")])</div><div class="col-lg-3">@include("laraflat::fileds.javascript.select" , ["name" => "modifiers[]", 'array' => $migrationModifiers + ['' => 'None'] , "label" => trans("laraflat::laraflat.Column")." ".trans("laraflat::laraflat.modifiers")])</div></div><div class="row"><div class="col-lg-3">@include("laraflat::fileds.javascript.select" , ["name" => "multi_lang[]", 'array' => yesNoArray() , "label" => trans("laraflat::laraflat.Language")])</div><div class="col-lg-2"><span class="btn btn-danger" onclick="removeThisColumn(this)" style="margin-top: 25px"><i class="fa fa-trash"></i></span></div></div></div>