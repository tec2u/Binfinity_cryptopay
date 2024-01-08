const express = require("express");
const {
    createWalletBtc,
    sendBitcoin,
    consultaHash,
    consultaSaldo,
} = require("./bitcoin.js");
const app = express();
app.use(express.json());
const PORT = 3000;

app.get("/api/create/wallet/btc", (req, res) => {
    try {
        const result = createWalletBtc();
        res.json(result);
    } catch (error) {
        res.json({
            message: error.message,
        });
    }
});

app.post("/api/send/wallet/btc", (req, res) => {
    try {
        const { receiver, sender, amount } = req.body;

        sendBitcoin(
            receiver, // recebe (adress)
            amount, // quantidade em BTC
            sender // quem paga (key)
        )
            .then((resp) => {
                // console.log(resp);
                res.json({ message: resp });
            })
            .catch((err) => {
                res.json({ message: err.message });
            });
    } catch (error) {
        res.json({
            message: error.message,
        });
    }
});

app.get("/api/query/wallet/btc/hash/:hash", (req, res) => {
    try {
        const hash = req.params.hash;
        consultaHash(hash)
            .then((response) => {
                res.json(response);
            })
            .catch((error) => {
                res.json({ error: error });
            });
    } catch (error) {
        res.json({ error: error });
    }
});

app.get("/api/query/wallet/btc/balance/:address", (req, res) => {
    try {
        const address = req.params.address;
        consultaSaldo(address)
            .then((saldo) => {
                res.json(saldo);
            })
            .catch((error) => {
                res.json({ error: error });
            });
    } catch (error) {
        res.json({ error: error });
    }
});

// Inicie o servidor
app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});
