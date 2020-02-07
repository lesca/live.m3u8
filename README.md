
# Why do I need this
一些网站不提供直接的直播地址，例如在地址后面跟一些有时效性的参数，时效过后原来的地址讲无法播放。
为了解决该问题，可以通过PHP来解析并返回可用的m3u8播放地址。

# Files
- live.php - the php file used to analize a source URL and find the real m3u8 address. In my example, the source file generates a json file. After find the real stream URL, the page change the HTML header to redirect to the real m3u8 source.
- .htaccess - some player doesn't accept .php extension, it is better to use .m3u8 as extention - so we need to use .htaccess to redirect .m3u8 to .php
