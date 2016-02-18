<div class="row cat-page-twoper" ng-repeat="t in p.Titles">
   
   <div class="col-xs-3">
      <div class="specblock">
         <img src="{{t.Cover}}" width="100%" alt="">
         <span class="spec"> <input type="text" ng-model="t.Publisher" placeholder="Publisher" class="ghost"></span>
         <span class="spec"> <input type="text" ng-model="t.ISBN" placeholder="ISBN" class="ghost"></span>
         <span class="spec"> <input type="text" ng-model="t.Format" placeholder="Format" class="ghost"></span>
         <span class="spec">
            USD <input type="text" ng-model="t.USPrice" ng-change="t.CalcPrice()" placeholder="$" ng-style="{'width': t.USPrice.length * 8 + 'px' }" style="width:auto;min-width:10px;" class="ghost">
            (CAN <input type="text" ng-model="t.CANPrice" placeholder="$" ng-style="{'width': t.CANPrice.length * 8 + 'px' }" style="width:auto;min-width:10px;" class="ghost">)
         </span>
         <span class="spec">
            <input type="text" ng-model="t.TrimWidth" placeholder="6" ng-style="{'width': t.TrimWidth.length * 8 + 'px' }" style="width:10px;min-width:10px;" class="ghost"> x
            <input type="text" ng-model="t.TrimHeight" placeholder="9" ng-style="{'width': t.TrimHeight.length * 8 + 'px' }" style="width:10px;min-width:10px;" class="ghost">
         </span>
         <span class="spec"> <input type="text" ng-model="t.Pages" placeholder="Pages" class="ghost"></span>
         <span class="spec"> <input type="text" ng-model="t.Bisac" placeholder="Bisac" class="ghost"></span>
         <span class="spec"> <input type="text" ng-model="t.PublicationDate" placeholder="PublicationDate" class="ghost"></span>
         <span class="spec"> <input type="text" ng-model="t.Discount" placeholder="Discount" class="ghost"></span>
         <span class="spec"> <input type="text" ng-model="t.Illlustrations" placeholder="Illlustrations" class="ghost"></span>
         <span class="spec"> <input type="text" ng-model="t.AgeRange" placeholder="AgeRange" class="ghost"></span>
         <span class="spec" ng-repeat="n in t.ExtraSpecs"> <input type="text" ng-model="n.Value" placeholder="Extra Spec" class="ghost"></span>

         <i class="fa fa-fw fa-plus" ng-click="t.AddSpec()" style="cursor: pointer;"></i>
      </div>
   </div>
   <div class="col-xs-9">
      <div class="body">
         
         
         
          <i class="fa fa-fw fa-plus" ng-click="p.AddTitle()" style="cursor: pointer;"></i>
         <i class="fa fa-fw fa-close pull-right" ng-click="p.AddTitle()" style="cursor: pointer;"></i>
         <i class="fa fa-fw fa-save pull-right" ng-click="p.AddTitle()" style="cursor: pointer;"></i>
         
         <span class="title">
            <input type="text" ng-model="t.Title" placeholder="Title" class="ghost"> 
         </span>
         
         <span class="subtitle">
            <input type="text" ng-model="t.Subtitle" placeholder="Subtitle" class="ghost">
         </span>
         <span class="author">
            <span ng-repeat="a in t.Authors">
               <input type="text" ng-model="a.Prefix" placeholder="Mr." ng-style="{'width': a.Prefix.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
               <input type="text" ng-model="a.FirstName" placeholder="Jake" ng-style="{'width': a.FirstName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
               <input type="text" ng-model="a.MiddleName" placeholder="A" ng-style="{'width': a.MiddleName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
               <input type="text" ng-model="a.LastName" placeholder="Ihasz" ng-style="{'width': a.LastName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
               <input type="text" ng-model="a.Suffix" placeholder="3rd" ng-style="{'width': a.Suffix.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
               ,
            </span>

            <i class="fa fa-fw fa-plus" ng-click="t.AddAuthor()" style="cursor: pointer;"></i>

         </span>
         <p class="body">
         <summernote airmode ng-model="t.MainDesc"></summernote>
         </p>
         <p class="body" ng-repeat="a in t.Authors">
         <summernote airmode ng-model="a.Description"></summernote>
         </p>
      </div>
      
   </div>
</div>