/**
 * Check if an url should be handled by css-loader.
 *
 * @param (string} url Url to check
 * @returns {boolean}
 */
function checkUrl(url) {
	// We only handle urls with a webpack loader.
	if (url.search(/^~!!/) !== -1) {
		return true;
	}

	return false;
}

module.exports = checkUrl;
