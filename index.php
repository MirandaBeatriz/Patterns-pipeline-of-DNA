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
    <py-env>    
        - matplotlib
    </py-env>

    <div id="plot"></div>
    <div id="freq"></div>

    <py-script output="plot">
        from array import array
        import matplotlib.pyplot as plt
        import numpy as np
        fig, ax = plt.subplots()

        #---------------------------------#

        Genome = "GGCTCACCGCAACCTCCACCGTCCTGAGTTAAAGTGATTCTCCTGTCTCAGCCCCCTGAGTAGCTAGGATTACAGGCGTGCGCCACCACACCCAGCTAATTTTTGTACTTTTAGTAGAGATGGGATTTCACCCTGTTGGTCAGGCTGGTCTTGAACTCCTGACCTAGTGATCTGCCCACCTTGGCCTCCCAAAGTGCTGGGATTACAGGCGTGAGCCACCACGCCTGGCTAGGGGAAGAGTGTTTTAAGAGCTCTGAGTAGAAGGGTCTAAGTGCAGACATCTTGGCTGTTGCTGAAGAATGTGACTCTCACCGCCTCCCTCTGACACTGTACCATCTCTTTTACCCCCATCCTTAGTCCACTCACGGAGGAGGCTGCCTTGATGGATTTGACTGCAGCTTCAAACACTTTCTTGGGCAAACGAAGGTTGGTGGTGCCACTGTCCACAATGCTCTTGTCATAGTTGTACTAAGAGGGAAAAGAGAGAGTTAAAAGAGTCAAAAGGTTTTTGATGCTGGGCTCTGGGCAGTAGGGGGTTACTGCTGGGGCCCCAGCTGGGTTGGCATCTTGGCTTTGGCACCTCCTAAGTGTACCTGCTTGGACAAGTTAACCTCTGTGCCTCAGTTCCTTCATCTCTAAAGTGAGGATAAAAATAGCACCTACCTCAAAGGGTTATTGTAAGGATTAAATAAATCAGCAATGTAAAGCACTTAGAATCGTGCCCAGCAGAGAGAAGGCACTTGGTAAATGTTTATTCTTGTTAATCTTGGGTGGGCAGGTAGTCTCCAAACTTGAAAATAAAAATACCTTGTTTAGTGCTTTTAAAAAAAAAAAAAAAAA"

        tGen = len(Genome)
        print("Tamanho genoma:", tGen)
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
            
            print ("Skew mínimo:" , m)
            print ("Posição:", min_skew)
            return (Skew)

        Skew = MinSkew(Genome)
        print(Skew)

        plt.title("Diagrama Skew")
        plt.xlabel("Posição")
        plt.ylabel("Skew")
        plt.plot(x, Skew)
        fig
    </py-script>

    <py-script output="freq">
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

        def FrequentWords(Text, k):
            words = []
            freq = FrequencyMap(Text, k)
            print("Mapa de frequências:", freq)
            m = max(freq.values())
            count=0
            for key in freq:
                if freq[key] == m:
                    pattern = key
                    words.append(pattern)
                count=count+1
            return words

        Words = FrequentWords(Genome, 3)
        print("Sequências mais frequentes:", Words)
    </py-script>

    <script defer src="https://pyscript.net/latest/pyscript.js"></script>
</body>
</html>