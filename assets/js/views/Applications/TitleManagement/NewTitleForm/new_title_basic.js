function BasicInfo(data, Dependencies, References) {
   var self = this;
   self.Model = {
      ProductGroupId: data.ProductGroupId || null,
      Title: data.Title || '',
      Subtitle: data.Subtitle || '',
      Publisher: data.Publisher || '',
      Imprint: data.Imprint || '',
      ContentLanguage: data.ContentLanguage || '',
      Series: data.Series || '',
      NumberinSeries: data.NumberinSeries || '',
      MainDescription: data.MainDescription || '',
      ShortDescription: data.ShortDescription || '',
   };
   
   self.FixedLanguageCodes = References.FixedISOLanguageCodes;

}