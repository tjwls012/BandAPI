# BandAPI

use tjwls012\bandapi\BandAPI;

$instance = BandAPI::getInstacne():

//visit site and get information → "https://developers.band.us/develop/guide/api"

$instance->getBands(string $acces_token);

$instance->getPosts(string $acces_token, string $band_key, string $locale);

$instance->writePost(string $acces_token, string $band_key, string $content, bool $do_push);

$instance->deletePost(string $acces_token, string $band_key, string $post_key);

$instance->getComments(string $acces_token, string $band_key, string $post_key, string $sort);

$instance->writeComment(string $acces_token, string $band_key, string $post_key, string $body);

$instance->deleteComment(string $acces_token, string $band_key, string $post_key, string $comment_key);

$instance->getPermissions(string $acces_token, string $band_key, string $permissions);

$instance->getAlbums(string $acces_token, string $band_key);

$instance->getPhotos(string $acces_token, string $band_key, string $photo_album_key);
