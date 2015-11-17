function BasicInfo(data) {
   var vm = this;
   vm.Title = data.Title || '';
   vm.Subtitle = data.Subtitle || '';
   vm.Publisher = data.Publisher || '';
   vm.Imprint = data.Imprint || '';
   vm.ContentLanguage = data.ContentLanguage || '';
   vm.Series = data.Series || '';
   vm.SeriesName = data.SeriesName || '';
   vm.NumberinSeries = data.NumberinSeries || '';
   vm.MainDescription = data.MainDescription || '';
   vm.ShortDescription = data.ShortDescription || '';
   vm.Errors = data.Errors || '';
}