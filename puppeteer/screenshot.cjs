import puppeteer from 'puppeteer-core';

(async () => {
  // Launch the browser with Puppeteer, setting appropriate flags
  const browser = await puppeteer.launch({
    executablePath: '/usr/bin/google-chrome', // Path to your Chrome installation
    headless: true, // Run in headless mode
    args: [
      '--no-sandbox',
      '--disable-setuid-sandbox',
      '--disable-gpu',
      '--disable-software-rasterizer',
      '--disable-dev-shm-usage',
      '--disable-crash-reporter', // Disable Crashpad (Crash reporting)
      '--disable-extensions', // Disable Chrome extensions (if any)
      '--remote-debugging-port=9222' // Debugging port (optional)
    ]
  });

  // Open a new page and navigate to the given URL
  const page = await browser.newPage();
  await page.goto(process.argv[2], { waitUntil: 'networkidle2' });

  // Take a screenshot and save it to the given path
  await page.screenshot({ path: process.argv[3] });

  // Close the browser
  await browser.close();
})();
