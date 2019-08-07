<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 07/07/2019
 * Time: 17:32
 *
 * simulates an ENUM
 *
 */

namespace constants;

abstract class AbstractLoginType {
    const API = 'api';
    const WEB = 'web';
    const TOK = 'token';
    const GOG = 'google';
    const MSO = 'office365';
    const FAB = 'facebook';

}