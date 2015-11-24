function BasicInfo(data) {
   var self = this;
   self.Title = data.Title || '';
   self.Subtitle = data.Subtitle || '';
   self.Publisher = data.Publisher || '';
   self.Imprint = data.Imprint || '';
   self.ContentLanguage = data.ContentLanguage || '';
   self.Series = data.Series || '';
   self.NumberinSeries = data.NumberinSeries || '';

   self.MainDescription = data.MainDescription || '';
   self.ShortDescription = data.ShortDescription || '';
}