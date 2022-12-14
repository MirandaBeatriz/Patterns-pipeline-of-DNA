<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PipeTest</title>
    <link rel="stylesheet" href="https://pyscript.net/latest/pyscript.css" />
    <link rel="stylesheet" href="style.css">
    <py-config>
        packages = [
            "matplotlib"
        ]
    </py-config>
</head>
<body>
    <div class="container">

        <h1>Faça o upload de um arquivo FASTA</h1>
        <div>
            <label for="file">Selecionar arquivo</label>
            <input type="file" name="file" id="file">
        </div>
        
        <py-env>    
            - matplotlib
        </py-env>
    
        <div class="table">
            <div>
                <small>Tamanho genoma</small>
                <p id="tamanho"></p>
            </div>
            <div>
                <small>Skew mínimo</small>
                <p id="minSkew"></p>
            </div>
        </div>
    
        <div id="plot"></div>
    
        <div>
            <h2>Mapa de frequências</h2>
            <p id="freqMap"></p>
        </div>
        
        <div>
            <h2>Sequências mais frequentes</h2>
            <p id="freqWords"></p>
        </div>

        <py-script output="tamanho">
            from array import array
            import matplotlib.pyplot as plt
            import numpy as np
            fig, ax = plt.subplots()
    
            Genome = "GGCTCACCGCAACCTCCACCGTCCTGAGTTAAAGTGATTCTCCTGTCTCAGCCCCCTGAGTAGCTAGGATTACAGGCGTGCGCCACCACACCCAGCTAATTTTTGTACTTTTAGTAGAGATGGGATTTCACCCTGTTGGTCAGGCTGGTCTTGAACTCCTGACCTAGTGATCTGCCCACCTTGGCCTCCCAAAGTGCTGGGATTACAGGCGTGAGCCACCACGCCTGGCTAGGGGAAGAGTGTTTTAAGAGCTCTGAGTAGAAGGGTCTAAGTGCAGACATCTTGGCTGTTGCTGAAGAATGTGACTCTCACCGCCTCCCTCTGACACTGTACCATCTCTTTTACCCCCATCCTTAGTCCACTCACGGAGGAGGCTGCCTTGATGGATTTGACTGCAGCTTCAAACACTTTCTTGGGCAAACGAAGGTTGGTGGTGCCACTGTCCACAATGCTCTTGTCATAGTTGTACTAAGAGGGAAAAGAGAGAGTTAAAAGAGTCAAAAGGTTTTTGATGCTGGGCTCTGGGCAGTAGGGGGTTACTGCTGGGGCCCCAGCTGGGTTGGCATCTTGGCTTTGGCACCTCCTAAGTGTACCTGCTTGGACAAGTTAACCTCTGTGCCTCAGTTCCTTCATCTCTAAAGTGAGGATAAAAATAGCACCTACCTCAAAGGGTTATTGTAAGGATTAAATAAATCAGCAATGTAAAGCACTTAGAATCGTGCCCAGCAGAGAGAAGGCACTTGGTAAATGTTTATTCTTGTTAATCTTGGGTGGGCAGGTAGTCTCCAAACTTGAAAATAAAAATACCTTGTTTAGTGCTTTTAAAAAAAAAAAAAAAAA"
    
            tGen = len(Genome)
            tGen
        </py-script>
    
        <py-script output="plot">
            x = np.arange(0,tGen)
    
            def MinSkew(Genome):
                min_skew=[]
                Skew=[]
                n=0
                m=0
                for i in range(len(Genome)):
                    if Genome[i]=="C":
                        n-=1
                        Skew.append(n)
                        
                    elif Genome[i]=="G":
                        n+=1
                        Skew.append(n)
    
                    else:
                        n=n
                        Skew.append(n)
    
                m= min(Skew)

                for i in range(len(Skew)):
                    if Skew[i]<=m:
                        min_skew.append(i)
                
                return (Skew)
    
            Skew = MinSkew(Genome)
    
            plt.title("Diagrama Skew")
            plt.xlabel("Posição")
            plt.ylabel("Skew")
            plt.plot(x, Skew)
            fig
        </py-script>

        <py-script output="minSkew">
            minSkew = min(Skew)
            minSkew
        </py-script>

        <py-script>
            def FrequencyMap(Text, k):
                freq = {}
                n = len(Text)
                for i in range (n-k+1):
                    Pattern = Text[i:i+k]
                    freq[Pattern] = 0
                    for i in range (n-k+1):
                        if Text[i:i+k] == Pattern:
                            freq[Pattern] = freq[Pattern] + 1
                return freq
        </py-script>

        <py-script output="freqMap">
            FreqMap = FrequencyMap(Genome, 3)
            FreqMap
        </py-script>
    
        <py-script output="freqWords">
            def FrequentWords(Text, k):
                words = []
                m = max(FreqMap.values())
                count=0
                for key in FreqMap:
                    if FreqMap[key] == m:
                        pattern = key
                        words.append(pattern)
                    count=count+1
                return words

            Words = FrequentWords(Genome, 3)
            Words
        </py-script>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script defer src="https://pyscript.net/latest/pyscript.js"></script>
</body>
</html>