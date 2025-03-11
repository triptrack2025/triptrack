import puppeteer from 'puppeteer-core';

const url = process.argv[2];
const imagePath = process.argv[3];

(async () => {
  const browser = await puppeteer.launch({
    headless: 'new',
    executablePath: '/usr/bin/google-chrome',
    args: [
      '--no-sandbox',
      '--disable-setuid-sandbox',
      '--disable-dev-shm-usage',
      '--disable-web-security',
      '--disable-gpu',
      '--disable-software-rasterizer',
      '--disable-features=IsolateOrigins,site-per-process',
    ],
  });

  const page = await browser.newPage();
  await page.goto(url, { waitUntil: 'networkidle2', timeout: 0 });
  await page.screenshot({ path: imagePath, fullPage: true });

  console.log('✅ Screenshot captured:', imagePath);

  await browser.close();
})();
