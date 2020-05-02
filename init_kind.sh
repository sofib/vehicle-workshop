TEMPORARY_DIR=".temp"
mkdir $TEMPORARY_DIR || echo "Temporary directory already here."
echo "Cleaning temp dir..."
rm -Rf $TEMPORARY_DIR/*

git clone git@github.com:sofib/plonk-bootstrap.git .temp/plonk-setup

sh $TEMPORARY_DIR/plonk-setup/kind.sh

faas-cli template pull https://www.github.com/sofib/openfaas-templates
faas-cli build -f entrypoint/FaaS/faas-stack.yml
docker push localhost:5000/wash:latest && docker push localhost:5000/repair:latest

faas-cli deploy -f entrypoint/FaaS/faas-stack.yml
