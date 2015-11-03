function BasicInfo(data) {
   var vm = this;
   vm.Title = data.Title || 'dsa';
   vm.Subtitle = data.Subtitle || 'Subtitle';
   vm.Publisher = data.Publisher || 'h.f.ullmann';
   vm.Imprint = data.Imprint || '';
   vm.ContentLanguage = data.ContentLanguage || '';
   vm.Series = data.Series || '';
   vm.SeriesName = data.SeriesName || '';
   vm.NumberinSeries = data.NumberinSeries || '';
   vm.MainDescription = data.MainDescription || '';
   vm.ShortDescription = data.ShortDescription || '';
   vm.Errors = data.Errors || '';
}