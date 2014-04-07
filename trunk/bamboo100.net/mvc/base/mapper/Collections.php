<?php
namespace MVC\Mapper;
require_once( "mvc/base/domain/Collections.php");
require_once( "mvc/base/mapper/Collection.php");

class AdsCollection 	extends Collection implements \MVC\Domain\AdsCollection{	function targetClass(){	return "\MVC\Domain\Ads";}}
class PagodaCollection 	extends Collection implements \MVC\Domain\PagodaCollection{	function targetClass(){	return "\MVC\Domain\Pagoda";}}
class CafeCollection 	extends Collection implements \MVC\Domain\CafeCollection{	function targetClass(){	return "\MVC\Domain\Cafe";}}
class KaraokeCollection extends Collection implements \MVC\Domain\KaraokeCollection{	function targetClass(){	return "\MVC\Domain\Karaoke";}}
class ZenMusicCollection extends Collection implements \MVC\Domain\ZenMusicCollection{	function targetClass(){	return "\MVC\Domain\ZenMusic";}}

class TCategoryCollection 	extends Collection implements \MVC\Domain\TCategoryCollection	{	function targetClass(){	return "\MVC\Domain\TCategory";}}
class TThemeCollection 		extends Collection implements \MVC\Domain\TThemeCollection		{	function targetClass(){	return "\MVC\Domain\TTheme";}}

class StoreCollection 	extends Collection implements \MVC\Domain\StoreCollection{	function targetClass(){	return "\MVC\Domain\Store";}}
class MStoreCollection 	extends Collection implements \MVC\Domain\MStoreCollection{	function targetClass(){	return "\MVC\Domain\MStore";}}

class RestaurantCollection 	extends Collection implements \MVC\Domain\RestaurantCollection{	function targetClass(){	return "\MVC\Domain\Restaurant";}}
class MRestaurantCollection extends Collection implements \MVC\Domain\MRestaurantCollection{function targetClass(){	return "\MVC\Domain\MRestaurant";}}

class HotelCollection 	extends Collection implements \MVC\Domain\HotelCollection{	function targetClass(){	return "\MVC\Domain\Hotel";}}
class MHotelCollection 	extends Collection implements \MVC\Domain\MHotelCollection{	function targetClass(){	return "\MVC\Domain\MHotel";}}

class CChessCollection 	extends Collection implements \MVC\Domain\CChessCollection{	function targetClass(){	return "\MVC\Domain\CChess";}}
class CBookCollection 	extends Collection implements \MVC\Domain\CBookCollection{	function targetClass(){	return "\MVC\Domain\CBook";}}
class CSetCollection 	extends Collection implements \MVC\Domain\CSetCollection{	function targetClass(){	return "\MVC\Domain\CSet";}}
class CStepCollection 	extends Collection implements \MVC\Domain\CStepCollection{	function targetClass(){	return "\MVC\Domain\CStep";}}

class PostCollection 	extends Collection implements \MVC\Domain\PostCollection{	function targetClass(){	return "\MVC\Domain\Post";}}
class ConfigCollection 	extends Collection implements \MVC\Domain\ConfigCollection{	function targetClass(){	return "\MVC\Domain\Config";}}
class GuestCollection 	extends Collection implements \MVC\Domain\GuestCollection{	function targetClass(){	return "\MVC\Domain\Guest";}}
class PageCollection 	extends Collection implements \MVC\Domain\PageCollection{	function targetClass(){	return "\MVC\Domain\Page";}}
class UserCollection 	extends Collection implements \MVC\Domain\UserCollection {	function targetClass(){	return "\MVC\Domain\User";}}

?>