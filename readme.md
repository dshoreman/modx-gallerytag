== MODx Gallery Tag ==



=== Installation ===

Grab the latest package from the Downloads page and upload to /path/to/modx/core/packages

Once uploaded, login to the Manager and go to System > Package Management.
From the Download Extras dropdown, choose Search Locally for Packages. Install the package when it finds it and that's it!

=== Basic Usage ===

The basic snippet call takes one parameter:
{{{
[[!galleryTag?albumId=`[[+gallery.id]]`]]
}}}


To customise the inner and outer templates, there are two extra parameters:
{{{
[[!galleryTag?albumId=`[[+gallery.id]]` &outerTpl=`my_tag_outer` &innerTpl=`my_tag_inner`]]
}}}

=== Changelog ===
Look in /core/components/gallerytag/docs/changelog.txt
