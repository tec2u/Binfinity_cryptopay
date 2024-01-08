const bitcoin = require("bitcoinjs-lib");
const { BIP32Factory } = require("bip32");
const ecc = require("tiny-secp256k1");
const bip32 = BIP32Factory(ecc);
const bip39 = require("bip39");
const ECPairFactory = require("ecpair");
const CryptoAccount = require("send-crypto");
const axios = require("axios");

// testnet
const network = bitcoin.networks.testnet;
const path = `m/44'/1'/0'/0`;

// main
// const network = bitcoin.networks.bitcoin;
// const path = `m/44'/0'/0'/0`;

function createWalletBtc() {
    try {
        let mnemonic = bip39.generateMnemonic();
        const seed = bip39.mnemonicToSeedSync(mnemonic);
        let root = bip32.fromSeed(seed, network);

        let account = root.derivePath(path);
        let node = account.derive(0).derive(0);

        let btcAddress = bitcoin.payments.p2pkh({
            pubkey: node.publicKey,
            network: network,
        }).address;

        console.log(`
      Wallet generated:

      - Address : ${btcAddress},
      - Key : ${node.toWIF()},
      - Mnemonic : ${mnemonic}

      `);

        return {
            Address: btcAddress,
            Key: node.toWIF(),
            Mnemonic: mnemonic,
        };
    } catch (error) {
        throw new Error(error.message);
    }
}

async function sendBitcoin(recieverAddress, amountToSend, privateKey1) {
    try {
        let result = await start(recieverAddress, amountToSend, privateKey1);
        // console.log(result);
        return result;
    } catch (error) {
        // throw new Error(error.message);
        return error.message;
    }
}

async function start(recieverAddress, amountToSend, privateKey1) {
    try {
        const ECPair = ECPairFactory.ECPairFactory(ecc);
        const privateKeyWIF = privateKey1;
        const keyPair = ECPair.fromWIF(privateKeyWIF, network);

        /* Load account from private key */
        //const privateKey = process.env.PRIVATE_KEY || CryptoAccount.newPrivateKey();
        const privateKey = keyPair.privateKey;
        const account = new CryptoAccount(privateKey, network);

        let transactionHash = null;
        let confirmation = null;

        // amountToSend = amountToSend * 100000000;

        const result = await account
            .send(recieverAddress, amountToSend, "BTC", {
                subtractFee: true,
            })
            .on("transactionHash", (saveHash) => {
                transactionHash = saveHash;
            })
            .on("confirmation", (confirm) => {
                confirmation = confirm;
            });

        // const txHash = await account
        //   .send("bc1q...", 0.01, "BTC")
        //   .on("transactionHash", console.log)
        //   .on("confirmation", console.log);
        console.log(transactionHash);
        console.log(await account.getBalance("BTC"));
        console.log(
            await account.getBalance("BTC", {
                address: recieverAddress,
            })
        );

        return {
            result,
            transactionHash,
            confirmation,
            balanceSender: await account.getBalance("BTC"),
            balanceReceiver: await account.getBalance("BTC", {
                address: recieverAddress,
            }),
        };
    } catch (error) {
        console.log(error.message);
        return error.message;
    }
}

async function consultaHash(hash) {
    const apiUrl = `https://blockchain.info/rawtx/${hash}`;
    // const apiUrl = `http://127.0.0.1:3000/api/create/wallet/btc/`;
    try {
        let retorno = await axios.get(apiUrl);
        return retorno.data;
    } catch (error) {
        return { error: error.message };
    }
}

async function consultaSaldo(address) {
    const apiUrl = `https://blockchain.info/rawaddr/${address}`;
    // const apiUrl = `http://127.0.0.1:3000/api/create/wallet/btc/`;
    try {
        let retorno = await axios.get(apiUrl);
        return retorno.data;
    } catch (error) {
        return { error: error.message };
    }
}

module.exports = { createWalletBtc, sendBitcoin, consultaHash, consultaSaldo };
