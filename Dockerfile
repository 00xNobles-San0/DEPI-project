FROM node:lts-alpine
RUN apk add curl
# Install dependencies using npm ci for reproducibility
WORKDIR /app
COPY package*.json ./
RUN npm ci
RUN npm install -g pm2

# Remove unnecessary files
RUN npm cache clean --force

RUN echo 'DEPI{test_flag_dont_submit_it_pllllzzz}' >> /flag.txt
# Copy the rest of the code
COPY . .

# Set the working directory for your app
WORKDIR /app

# Expose the port your app listens on (adjust as needed)
EXPOSE 3000

# Start your application (replace with your command)
CMD ["pm2", "start", "index.js", "--watch", "--no-daemon"]
