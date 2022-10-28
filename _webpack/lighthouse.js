const meow = require('meow');
const isUrl = require('is-url-superb');
const chalk = require('chalk');
const prompts = require('prompts');
const boxen = require('boxen');

const launchChromeAndRunLighthouse = require('./lighthouse/run');

const opts = require('./lighthouse/opts');

// Wrap everything in an async function so that we can use await inside.
(async () => {
	// Parse output with meow.
	const cli = meow(`
		Usage
		  $ lighthouse [testUrl]
	 
		Examples
		  $ lighthouse https://www.datamints.com --direct
	`, {
		description: 'Runs a test with Google Lighthouse on a url'
	});

	// Check if we have a url, otherwise ask the user.
	let testUrl = cli.input.length > 0 ? cli.input[0].trim() : '';
	if (testUrl === '') {
		// Define questions.
		const questions = [
			{
				type: 'text',
				name: 'testUrl',
				message: 'What url should Lighthouse be run at?',
				validate: testUrl => isUrl(testUrl)
			}
		];

		// Wait for user input and take over the url.
		const response = await prompts(questions);
		testUrl = response.testUrl;
	}

	// Validate the url.
	if (!isUrl(testUrl)) {
		console.error(chalk.red('Given argument "' + testUrl + '" is not a valid url'));
		process.exit(0);
	}

	// Run lighthouse.
	const results = await launchChromeAndRunLighthouse(testUrl, opts);

	// Evaluate Lighthouse results.
	// results contains the following parts:
	// - results.lhr is the JS-consumeable output (https://github.com/GoogleChrome/lighthouse/blob/master/types/lhr.d.ts)
	// - results.report is the HTML/JSON/CSV output as a string
	// - results.artifacts is for use in trace/screenshots/other specific case you need (rarer)
	const score = results.lhr.categories.performance.score * 100;
	let result = 'Score: ';
	if (score <= 49) {
		result += chalk.red.bold(score);
	}
	else if (score <= 89) {
		result += chalk.orange.bold(score);
	}
	else {
		result += chalk.green.bold(score);
	}
	console.log(boxen(result, { padding: 2, margin: 2, borderStyle: 'double' }));
})();
