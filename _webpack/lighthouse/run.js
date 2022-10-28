const lighthouse = require('lighthouse');
const chromeLauncher = require('chrome-launcher');

/**
 * Run Lighthouse via Chrome.
 *
 * @param {String} url Url to run Lighthouse on
 * @param {Object} opts Options
 * @param {Object} config Lighthouse configuration (see https://github.com/GoogleChrome/lighthouse/blob/master/docs/configuration.md)
 * @returns {Promise<{}>}
 */
function launchChromeAndRunLighthouse(url, opts, config = null) {
	return chromeLauncher.launch({chromeFlags: opts.chromeFlags}).then(chrome => {
		opts.port = chrome.port;

		return lighthouse(url, opts, config).then(results => {
			return chrome.kill().then(() => results);
		});
	});
}

module.exports = launchChromeAndRunLighthouse;
